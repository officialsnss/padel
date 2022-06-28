<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function customers()
    {
       
        $title = 'Customers';
        $appUsers = User::whereIn('role', [3, 4])->get();
        
        return view('backend.pages.users.customer', compact('title', 'appUsers'));
    }

    public function view($id){
        $title = 'User Detail';
        $userInfo = User::where('id', $id)->get();
        return view('backend.pages.users.details', compact('title','userInfo'));
    }

    public function updateStatus(Request $request)
{
        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully.']);
}

    /**
     * Show the application contact.
     *
     * @return \Illuminate\View\View
     */
    public function courtOwners()
    { 
        $title = 'Court Owners';
       return view('backend.pages.users.court-owner', compact('title'));
    }
}