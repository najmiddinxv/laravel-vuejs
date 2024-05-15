<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserNotification;

class UserNotificationController extends Controller
{
    public function index()
    {
        // $usernotifications = auth()->user()->notifications();
        $usernotifications = User::first()->notifications;

        return view('backend.usernotification.index',[
            'usernotifications' => $usernotifications,
        ]);
    }
    public function show($id)
    {
        // $user = App\Models\User::find(1);
        // $user->unreadNotifications()->update(['read_at' => now()]);

        // $usernotifications = auth()->user()->notifications();
        $usernotification = UserNotification::where('id', $id)->first();
        $usernotification->update(['read_at' => now()]);

        return view('backend.usernotification.show',[
            'usernotification' => $usernotification,
        ]);
    }
}
