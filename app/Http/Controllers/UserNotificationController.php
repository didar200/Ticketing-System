<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserNotification;

class UserNotificationController extends Controller
{
    public function emailNotification()
    {
    	$notify = UserNotification::find(1);

    	if($notify == null)
    	{
    		$notify = new UserNotification();
    		$notify->notification_name = 'email';
    		$notify->notification_status = 0;
    		$notify->save();
    		return view('settings.notification', compact('notify'));
    	}

    	return view('settings.notification', compact('notify'));
    }

    public function emailNotificationProcess(Request $request)
    {
    	$notify = UserNotification::find(1);

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
