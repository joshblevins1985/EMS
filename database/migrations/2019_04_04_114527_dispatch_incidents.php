<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DispatchIncidents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('patient_id', 10)->nullable();
            $table->dateTime('pick_up');
            $table->dateTime('expected_complete')->nullable();
            $table->string('incident_type', 10);
            $table->string('unit', 10)->nullable();
            $table->string('facility_id', 10)->nullable();
            $table->string('incident_address')->nullable();
            $table->string('incident_city', 50)->nullable();
            $table->string('incident_state', 50)->nullable();
            $table->string('incident_zip', 10)->nullable();
            $table->string('incident_number', 20);
            $table->string('call_back')->nullable();
            $table->string('priority', 10);
            $table->string('primary_station', 10);
            $table->string('desitination_facility_id', 10)->nullable();
            $table->string('destination_address')->nullable();
            $table->string('destination_city', 50)->nullable();
            $table->string('destination_state', 50)->nullable();
            $table->string('destination_zip', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatch_incidents');
    }
}
