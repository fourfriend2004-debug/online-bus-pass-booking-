<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pass extends Model

{
     protected static function boot()
    {
        parent::boot();

        static::creating(function ($pass) {
            if (empty($pass->icard_no)) {
                // Format: BP-2026-00001
                $year = date('Y');
                $lastId = Pass::max('id') + 1;

                $pass->icard_no = 'BP-' . $year . '-' . str_pad($lastId, 5, '0', STR_PAD_LEFT);
            }
        });
    }
    protected $table = 'passes';

    protected $fillable = [
        'pass_type','user_id','icard_no',
        'student_name','dob','gender','is_rural',
        'district_perm','block_perm','cluster_perm','village_perm','perm_address',
        'district_curr','block_curr','cluster_curr','village_curr','curr_address',
        'section','roll_no','class','class_group','school_name','school_address','category',
        'full_name','passenger_dob','occupation',
        'mobile','email','district','block','village','address','pincode',
        'from_location','to_location','route','bus_type','pass_duration','academic_year',
        'payment_method','price',
        'status','expiry_date',
        'aadhaar','bonafide','photo','signature','ration'
    ];

    public function user()
    {
        return $this->belongsTo(Reg::class, 'user_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'pass_id');
    }

    public function getIsExpiredAttribute()
    {
        return $this->expiry_date && Carbon::today()->gt($this->expiry_date);
    }
}
