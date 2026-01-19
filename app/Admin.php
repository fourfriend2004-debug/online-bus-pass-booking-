<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'system_name',
        'support_email',
        'max_active_pass',
        'old_pass_valid_days'
    ];

    protected $hidden = ['password'];
}
