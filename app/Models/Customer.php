<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pop;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'phone',
        'address',
        'pop_id',
        'status',
    ];

    public function pop()
    {
    	return $this->belongsTo(Pop::class);
    }
}
