<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name',
        'slug',
        'status',
    ];

    public function users()
    {
    	return $this->belongsToMany(User::class, 'user_groups')->orderBy('first_name');
    }

}
