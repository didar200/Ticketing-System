<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //\App\Models\User::factory(100)->create();

    	\App\Models\User::create([
    		'first_name' => 'Didarul',
            'last_name' => 'Islam',
            'email' => 'didar@royalgreen.net',
            'phone' => '01816641042',
            'photo' => '/assets/images/default.png',
            'email_verified_at' => NULL,
            'password' => Hash::make('rgl321'),
            'status' => 1,
            'role' => 1,
            'remember_token' => NULL,
    	]);

    	\App\Models\UserNotification::create([
    		'notification_name' => 'email',
            'notification_status' => 0,
    	]);

    	\App\Models\SmtpConfiguration::create([
    		'host' => 'mail.example.com',
            'port' => '25',
            'encryption' => NULL,
            'username' => 'test@example.com',
            'password' => 'password',
            'name' => 'Ticketing System',
            'address' => 'test@example.com',
    	]);


    }
}
