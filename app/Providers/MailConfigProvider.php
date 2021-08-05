<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SmtpConfiguration;
use Illuminate\Support\Facades\Config;

class MailConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $configuration = SmtpConfiguration::find(1);

        // $config = array(
        //     'driver'     =>     'smtp',
        //     'mailers'    =>     'smtp',
        //     'transport'  =>     'smtp',
        //     'host'       =>     $configuration->host,
        //     'port'       =>     $configuration->port,
        //     'username'   =>     $configuration->username,
        //     'password'   =>     $configuration->password,
        //     'encryption' =>     $configuration->encryption,
        //     'from'       =>     array('address' => $configuration->address, 'name' => $configuration->name),
        // );

        // Config::set('mail', $config);
    }
}
