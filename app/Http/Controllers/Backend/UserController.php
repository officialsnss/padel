<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Club;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
        try{
            $request->validate([
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password'
            ]);
           
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
                'clubname' => 'required|string',
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
    


}