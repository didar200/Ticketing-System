<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function emailNotification()
    {
    	$notify = Notification::find(1);
    	return view('settings.notification', compact('notify'));
    }

    public function emailNotificationProcess(Request $request)
    {
    	$notify = Notification::find(1);

    	if($request->email == null)
    	{
    		$status = 0;
    	}
    	else
    	{
    		$status = 1;
    	}

    	$notify->notification_status = $status;

    	$notify->save();

    	return back()->with('save', 'Information Saved');
    }
}
