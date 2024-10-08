<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotificationEmail;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsyncNotificationController extends Controller
{
    function subscribeNotification(Request $request)
    {
        $type = $request->input("type");
        $unsubscribe = $request->input("unsubscribe");

        if ($unsubscribe) {
            Auth::user()->notificationTypes()->detach($type);
            return back()->with("status", "UnSubscribed Successfully");
        }

        Auth::user()->notificationTypes()->attach($type);
        return back()->with("status", "Subscribed Successfully");
    }
    function sendNotification(Request $request)
    {
        $type = $request->input("type");
        $users = User::whereHas('notificationTypes', function ($q) use ($type) {
            $q->where('type', $type);
        })->get();

        $notification = new Notification();
        $notification->type = $type;
        $notification->message =  "This is an $type notification";
        $notification->status = 'pending';
        $notification->save();


        foreach ($users as $user) {
            SendNotificationEmail::dispatch($notification, $user);
        }


        return back()->with("status", "Notification sent to subscribers Successfully");
    }
}
