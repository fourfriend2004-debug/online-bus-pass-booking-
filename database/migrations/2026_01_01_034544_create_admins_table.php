<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');

            // Login
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // System Settings
            $table->string('system_name')->default('BusPass Booking System');
            $table->string('support_email')->default('support@buspass.com');

            // PASS SETTINGS (NEW)
            $table->integer('max_active_pass')->default(1);
            $table->integer('old_pass_valid_days')->default(365);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
