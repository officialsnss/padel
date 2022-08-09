<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Club;
use Redirect;
use App\Models\Wallets;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Notifications\PasswordReset as ResetPasswordRequest;
use App\Models\Api\PasswordReset;
use App\Notifications\PasswordResetSuccess;
use Str;

class UserController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */

     // Customer Listing
    public function customers()
    {
      try{ 
        $title = 'Customers';
        $appUsers = User::whereIn('role', [3, 4])->get();
        
        return view('backend.pages.users.customer', compact('title', 'appUsers'));
      }
      catch (\Exception $e) {
        return redirect('/admin')->with('error', 'Something went wrong.');
      }
    }

     // Customer Details
    public function view($id){
        try{
            $title = 'User Detail';
            $userInfo = User::where('id', $id)->first();
            return view('backend.pages.users.details', compact('title','userInfo'));
        } 
        catch (\Exception $e) {
            return redirect('/admin/users/customers')->with('error', 'Something went wrong.');
         }
  }

    // Customer Status Updation
    public function updateStatus(Request $request)
    {
        try{
            $user = User::findOrFail($request->user_id);
            $user->status = $request->status;
            $user->save();

            return response()->json(['message' => 'User status updated successfully.']);
        }
        catch (\Exception $e) {
            return redirect('/admin/users/customers')->with('error', 'Something went wrong.');
        }
    }

    // Reset Password
    public function resetPassword(Request $request, $id)
    {
       try{
            $user = User::findOrFail($id);
            $userId = $id;
            $userEmail = $user->email;
            $title = 'Reset Password';
            return view('backend.pages.users.resetPassword', compact('title', 'userEmail','userId'));
       }
       catch (\Exception $e) {
          return redirect('/admin/users/customers')->with('error', 'Something went wrong.');
       } 
    }

    // Reset Password
    public function newPassword(Request $request, $id)
    {
       
            $request->validate([
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password'
            ]);
          try{
            $user = User::findOrFail($id);
            $user->password = bcrypt($request->password);
       
            $user->save(); 
           
            return redirect('/admin/users/customers')->with('success', 'Password reset successfully');
        }
        catch (\Exception $e) {
            return redirect('/admin/users/customers')->with('error', 'Something went wrong.');
         } 
    
    }
   // Court Owner Listing
    public function courtOwners()
    { 
      try{
        $title = 'Court Owners';
        $courtUsers = User::whereIn('role', [5])->get();
        return view('backend.pages.users.court-owner', compact('title','courtUsers'));
      }
      catch (\Exception $e) {
        return redirect('/admin')->with('error', 'Something went wrong.');
      }
    }

    // Adding new courtowner
    public function create()
    { 
       try{
        $title = 'Add Court Owners';
        return view('backend.pages.users.create', compact('title'));
       }
       catch (\Exception $e) {
        return redirect('/admin/users/court-owners')->with('error', 'Something went wrong.');
       } 
    }

    public function add(Request $request)
    {
            $request->validate([
                'fullname' => 'required|string',
                'clubname' => 'required|string|unique:clubs,name',
                'email'=> 'required|email|unique:users' , 
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password'
            ]);
        try{
         
           $result = User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'role'=> 5,
            'password' => Hash::make($request->password),
        ]);
       
        if($result){
          $result = Club::create([
            'name' => $request->clubname,
            'user_id' => $result->id,
        ]);
          return redirect('/admin/users/court-owners')->with('success', 'Court Owner Created Successfully.');
        }
      }
        catch (\Exception $e) {
        
            return redirect('/admin/users/court-owners')->with('error', 'Something went wrong.');
         }
    }

    //Wallets Manage
    public function wallets($id)
    {
        try{
            $title = 'Wallets';
          
            $wallets = Wallets::leftJoin('currencies', 'currencies.id' ,'=', 'wallets.currency_id')
            ->where('wallets.user_id', $id)
            ->get();
            $book = 0;
            $refund = 0;
            foreach($wallets as $wallet){
               
              if($wallet->status == '1'){
              
                $refund+= $wallet->amount;
              }
              else{
                
                $book+= $wallet->amount;
              }

                     
            }
            $balance =  $refund - $book;
            $userId = $id;
           return view('backend.pages.wallets', compact('title','wallets','balance', 'userId'));
        }
        catch (\Exception $e) {
          // dd($e->getMessage());
            return redirect('/admin/users/wallets')->with('error', 'Something went wrong.');
        }      
    }


    //Wallets Withdraw 
    public function walletsClear(Request $request, $id){
     
      try{ 
          $result = Wallets::create([
                  'amount' => $request->withdrawal_amt,
                  'user_id' => $id,
                  'currency_id' => '129',
                  'status' => 3,
              
          ]);
      
          if($result){
            
             return Redirect::back()->with('success', 'Withdraw amount Successfully.');
          }
      }
      catch (ValidationException  $e) {
         //dd($e->getMessage());
      return redirect('/admin/users/wallets')->with('error', 'Something went wrong.');
      }
  }  
  
  public function sendMail(Request $request)
  {
    
      // Getting data from the users table
      $user = User::where('email', $request->email)->first();
     
      if (!$user) {
       return back()->with('message', 'This email does not exist. Please try again.');
         // return ResponseUtil::errorWithMessage('This email does not exist. Please try again.', false, 200);
      }
      if(($user->role == '5') || ($user->role == '4')){
        return back()->with('message', 'Please contact your admin to change the password.');
      
      }
     
      //Updating or creating token value in password_reset table
      $passwordReset = PasswordReset::updateOrCreate([
          'email' => $user->email,
      ], [
          'token' => Str::random(60),
      ]);
     
      // Calling Noitication to send mail to the user
      if ($passwordReset) {
          $user->notify(new ResetPasswordRequest($passwordReset->token, $passwordReset->email));
      }
     
      return back()->with('status', 'We have e-mailed your password reset link!');
     // return ResponseUtil::successWithMessage("We have sent a link to your email. Please check and follow the instructions!", true, 200);
  }

  public function reset(Request $request)
  {
      // Validate the input fields
      $request->validate([
          'email' => 'required|email',
          'password' => 'required|min:8',
          'password_confirmation' => 'required|same:password'
      ]);
      $passwordReset = PasswordReset::where('token', $request->token)->first();

      // For wrong token case fails
      if (!$passwordReset) {
         return back()->with('message', 'This password reset token is invalid.');
       
      }

      // For invalid user case fails
      $user = User::where('email', $passwordReset->email)->first();
      if (!$user) {
        return back()->with('message', 'We cannot find a user with that e-mail address.');
     }

      $user->password = bcrypt($request->password);
      $user->remember_token = str_random(60);
      $user->save();  // updating the password and remember_token in the users table
      $passwordReset->delete(); // delete the value from password_reset table
      $user->notify(new PasswordResetSuccess($request->password));
      return back()->with('status', 'New password has been sent to your email. Please check.');
     
  }
    


}