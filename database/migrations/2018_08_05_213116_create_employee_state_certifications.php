<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeStateCertifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_state_certifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('state')->index();
            $table->string('certification_level');
            $table->date('expiration');
            $table->string('verification')->nullable();
            $table->string('status')->index();
            $table->string('certification_number');
            $table->string('user_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_state_certifications');
    }
}