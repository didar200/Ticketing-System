<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmtpConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        "host",
        "port",
        "encryption",
        "username" ,
        "password",
        "name",
        "address"
    ];
}
