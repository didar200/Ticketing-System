<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Group;
use App\Models\Customer;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'group_id',
        'created_user',
        'status',
        'attachment',
        'title',
        'descriptipn',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function group()
    {
    	return $this->belongsTo(Group::class);
    }

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
