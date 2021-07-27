<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\EmailNotification;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Ticket;

class LoginController extends Controller
{
    
    public function login()
    {
    	return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
    	$request->validate([
    		'email' => 'required',
    		'password' => 'required'
    	]);

    	if(auth()->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1]))
    	{

    		return redirect()->route('dashboard');
    	}
    	
    	return back()->with('login_error', 'Invalid Credentials!!');
     	
    }

    public function logout()
    {
    	auth()->logout();

    	return redirect()->route('login');
    }

    public function forgotPassword()
    {
    	return view('auth.forgotPassword');
    }

    public function forgotPasswordProcess(Request $request)
    {

    	$user = User::where('email', $request->email)->first();

    	if($user == null)
    	{
    		return back()->with('email_error', 'User does not exists');	
    	}

    	$token = Str::random(32);

    	$user->token = $token;

    	$user->save();

    	$user->notify(new EmailNotification($user));

    	return back()->with('email_success', 'Please check your email to reset password');
    	
    }

    public function resetPassword($token)
    {
    	$user = User::where('token', $token)->first();

    	if($user == null)
    	{
    		return redirect()->route('login');	
    	}

    	return view('auth.resetPassword', compact('user'));
    	
    }

    public function resetPasswordProcess(Request $request)
    {
    	$request->validate([
            'new_password' => 'confirmed|min:6'
        ]);

        $user = User::find($request->id);

        $user->token = NULL;

        $user->password = bcrypt($request->new_password); 

        $user->save();

        return back()->with('pass_change', 'Password has been changed successfully!');
    	
    }

    
}
