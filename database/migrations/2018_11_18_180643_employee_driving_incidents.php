<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeDrivingIncidents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_driving_incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('employee_id', 10);
            $table->date('date');
            $table->string('incident_type', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_driving_incidents');
    }
}
