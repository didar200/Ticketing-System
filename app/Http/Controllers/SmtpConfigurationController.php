<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmtpConfiguration;

class SmtpConfigurationController extends Controller
{
    public function smtpConfigure()
    {
    	$smtp = SmtpConfiguration::find(1);

    	return view('settings.smtpConfigure', compact('smtp'));
    }

    public function smtpConfigureProcess(Request $request)
    {
    	$request->validate([
    		'host' => 'required',
    		'port' => 'required',
    		'username' => 'required',
    		'password' => 'required',
    		'address' => 'required',
    		'name' => 'required',
    	]);

    	$smtp = SmtpConfiguration::find(1);

    	$smtp->host = $request->host;
    	$smtp->port = $request->port;
    	$smtp->username = $request->username;
    	$smtp->password = $request->password;
    	$smtp->encryption = $request->encryption;
    	$smtp->address = $request->address;
    	$smtp->name = $request->name;

    	$smtp->save();

    	return back()->with('save', 'Information Saved');

    }
}
