<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //protected $table = 'users';
    protected $fillable = [
        'name', 'username', 'email', 'password', 'school_code', 'class_code'
    ];
}