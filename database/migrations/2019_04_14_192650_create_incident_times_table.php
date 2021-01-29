<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_times', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('incident_id');
            $table->dateTime('dispatch_acknowledged')->nullable();
            $table->dateTime('dispatched')->nullable();
            $table->dateTime('unit_acknowledged')->nullable();
            $table->dateTime('enroute')->nullable();
            $table->dateTime('atscene')->nullable();
            $table->dateTime('atpatient')->nullable();
            $table->dateTime('airmedcalled')->nullable();
            $table->dateTime('airmedos')->nullable();
            $table->dateTime('airmedlo')->nullable();
            $table->dateTime('transporting')->nullable();
            $table->dateTime('arrived')->nullable();
            $table->dateTime('available')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_times');
    }
}
