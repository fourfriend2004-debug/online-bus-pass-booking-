<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'user_id','pass_id','method',
        'card_number','card_holder','expiry',
        'upi_id','status'
    ];

    public function pass()
    {
        return $this->belongsTo(Pass::class, 'pass_id');
    }

    public function user()
    {
        return $this->belongsTo(Reg::class, 'user_id');
    }
}
