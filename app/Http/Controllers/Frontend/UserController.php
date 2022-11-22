<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ResponseUtil;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function player_lists()
    {
        return view('frontend.pages.players');
    }

    public function myProfile()
    {
        $user = auth()->user();
        return view('frontend.pages.profile', ['user' => $user]);
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('frontend.pages.changeprofile', ['user' => $user]);
    }

    public function notificationSettings(Request $request)
    {       
        $userId = auth()->user()->id;

        if($request->isNotification == 1) {
            // If user wants to enable the notification
            User::where('id', $userId)->update(['notification' => '1']);
            $test = User:: get('notification');
            return response()->json(['code' => 200, 'success' => true, 'message' => "Notification settings updated!", 'isNotification' => true], 200);
        } elseif ($request->isNotification == 0) {
            // If user wants to disable the notification
            User::where('id', $userId)->update(['notification' => '0']);
            return response()->json(['code' => 200, 'success' => true, 'message' => "Notification settings downgraded!", 'isNotification' => false], 200);
        } else {
            // Validation for the empty field
            return ResponseUtil::errorWithMessage(201, 'Please enter the value of isNotification.', false, 201);
        }
    }
}
