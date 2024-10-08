<?php

namespace App\Http\Controllers;

use App\Events\RealTimeNotificationEvent;
use App\Models\Notification;
use Illuminate\Http\Request;

class RealtimeNotificationController extends Controller
{
    function sendNotification(Request $request)
    {
        $type = $request->input("type");


        $notification = new Notification();
        $notification->type = $type;
        $notification->message =  $request->message;
        $notification->status = 'pending';
        $notification->save();


        RealTimeNotificationEvent::dispatch($request->message, $request->sender, $type);

        $notification->status = 'sent';
        $notification->save();


        return response()->json(['message' => 'Notifications are being sent!']);
    }
}
