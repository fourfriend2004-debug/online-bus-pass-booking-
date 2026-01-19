<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusroutesTable extends Migration
{
    public function up()
    {
       Schema::create('busroutes', function (Blueprint $table) {
    $table->increments('id');
    $table->string('from');
    $table->string('to');

    // 4 Types of Price
    $table->decimal('local_student_price', 10, 2);
    $table->decimal('local_passenger_price', 10, 2);
    $table->decimal('express_student_price', 10, 2);
    $table->decimal('express_passenger_price', 10, 2);

    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('busroutes');

    }
}
