<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autologin extends Model
{
    protected $table = 'autologin';
    protected $fillable = [
        'moodle_username', 'laravel_username', 'login_status'
    ];
}
