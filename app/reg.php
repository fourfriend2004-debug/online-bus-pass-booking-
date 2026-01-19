<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reg extends Model
{
    protected $table = 'regs';

    protected $fillable = [
        'name','email','no','pass','phone',
        'dob','gender','city','address','pincode','photo'
    ];

    public function passes()
    {
        return $this->hasMany(Pass::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }
}
