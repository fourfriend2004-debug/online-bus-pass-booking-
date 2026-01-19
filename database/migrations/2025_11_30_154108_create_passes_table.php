<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassesTable extends Migration
{
    public function up()
    {
        Schema::create('passes', function (Blueprint $table) {

            $table->increments('id');

            $table->string('pass_type');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('icard_no')->nullable();

            // Student
            $table->string('student_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('is_rural')->nullable();

            $table->string('district_perm')->nullable();
            $table->string('block_perm')->nullable();
            $table->string('cluster_perm')->nullable();
            $table->string('village_perm')->nullable();
            $table->string('perm_address')->nullable();

            $table->string('district_curr')->nullable();
            $table->string('block_curr')->nullable();
            $table->string('cluster_curr')->nullable();
            $table->string('village_curr')->nullable();
            $table->string('curr_address')->nullable();

            $table->string('section')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('class')->nullable();
            $table->string('class_group')->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_address')->nullable();
            $table->string('category')->nullable();

            // Passenger
            $table->string('full_name')->nullable();
            $table->date('passenger_dob')->nullable();
            $table->string('occupation')->nullable();

            // Common
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();

            $table->string('district')->nullable();
            $table->string('block')->nullable();
            $table->string('village')->nullable();
            $table->string('address')->nullable();
            $table->string('pincode')->nullable();

            $table->string('from_location')->nullable();
            $table->string('to_location')->nullable();
            $table->string('route')->nullable();
            $table->string('bus_type')->nullable();
            $table->string('pass_duration')->nullable();
            $table->string('academic_year')->nullable();

            $table->string('payment_method')->nullable();
            $table->decimal('price', 10, 2)->nullable();

            // IMPORTANT
            $table->string('status')->default('pending'); // pending / approved
            $table->date('expiry_date')->nullable();

            // Uploads
            $table->string('aadhaar')->nullable();
            $table->string('bonafide')->nullable();
            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->string('ration')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('passes');
    }
}
