<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Busroute extends Model
{
    protected $table = "busroutes";

    protected $fillable = [
    'from', 'to',
    'local_student_price', 'local_passenger_price',
    'express_student_price', 'express_passenger_price'
];

}
