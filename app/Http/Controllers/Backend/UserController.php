<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Club;
use Redirect;
use App\Models\Regions;
use App\Models\Cities;
use App\Models\Amenities;
use App\Models\Countries;
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
        $countries = Countries::all();
        $amenities = Amenities::all();
        $regions = Regions:: leftJoin('countries', 'regions.country_id', '=', 'countries.id')
                    ->select('regions.*','countries.name as cname')
                    ->get();

        return view('backend.pages.users.create', compact('title','countries','amenities','regions'));
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
           $clubName = $request->clubname;
          $data = $request->except('_method','clubname','fullname','email','phone', 'password','_token','submit', 'password_confirmation');
          $amList = implode(',', $request->amenities);
        
          $data['amenities'] = $amList;
          $data['user_id'] =  $result->id;
          $data['name'] =  $clubName;

          if($request->file('featured_image')){
            $file= $request->file('featured_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('Images/club_images'), $filename);
            $data['featured_image']= $filename;
             }
       
         $finalresult = Club::insert($data);
         
          return redirect('/admin/users/court-owners')->with('success', 'Court Owner Created Successfully.');
        }
      }
        catch (\Exception $e) {
           //dd($e->getMessage());
            return redirect('/admin/users/court-owners')->with('error', 'Something went wrong.');
         }
    }

     // Vendor Details
     public function courtOwnersview($id){
     
      try{
          $title = 'Court Owners Detail';
          $userInfo = User::leftJoin('clubs','users.id', '=', 'clubs.user_id')
            ->leftJoin('currencies', 'currencies.id' ,'=', 'clubs.currency_id')
            ->leftJoin('regions', 'regions.id' ,'=', 'clubs.region_id')
            ->leftJoin('cities', 'cities.id' ,'=', 'clubs.city_id')
            ->leftJoin('countries', 'countries.id' ,'=', 'clubs.country')
            ->where('users.id', $id)
            ->select('users.*', 'clubs.*', 'clubs.id as clubid','clubs.name as clubname','users.name as username','currencies.code', 'regions.name as region', 'cities.name as city','countries.name as country')
            ->first();

          $amenityList = [];
         if($userInfo->amenities != 'NULL'){
          $amenityList = [];
          $lists = explode(',', $userInfo->amenities);
          foreach( $lists as $amentityID){
             $amenityList[] = $this->amentityName($amentityID);
          }
          $amenityList = implode(',', $amenityList);
         }
         // dd($userInfo);
          return view('backend.pages.users.clubdetails', compact('title','userInfo','amenityList'));
      } 
      catch (\Exception $e) {
       // dd($e->getMessage());
          return redirect('/admin/users/court-owners')->with('error', 'Something went wrong.');
       }
       }

        //Get Amenity
        public function amentityName($id){
          $res = Amenities::where('id',$id)->first();
          if($res){
            return $res->name;
          }
        else{
          return ; 
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
      return back()->with('status', 'Ypur password has been updated and has been sent to your email. Please check.');
     
  }


  // Get Region
  public function getUserRegion(Request $request){
     $regions = Regions::where('country_id', $request->country_id)
    ->get();

    if($request->country_id == null){
       // dd($request->country_id);
        echo '<option value="">Select Country First</option>'; 
    }
    elseif(!$regions->isEmpty()){
        foreach($regions as $region){
           
            echo '<option value="'.$region->id.'">'.$region->name.'</option>'; 
        }
    }
    else{
        echo '<option value="">Region not available</option>'; 
    }
  }

  // Get City
  public function getUserCity(Request $request){
   
    $cities = Cities::where('region_id', $request->region_id)
    ->get();
    if($request->region_id == null){
        echo '<option value="">Select Region First</option>'; 
    }
    elseif(!$cities->isEmpty()){
    foreach($cities as $city){
      
            echo '<option value="'.$city->id.'">'.$city->name.'</option>'; 
        }
    }
    else{
        echo '<option value="">City not available</option>'; 
    }
  // return $regions;
}


}