<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('unit_id');
            $table->integer('user_id');
            $table->boolean('wipers')->nullable();
            $table->boolean('head_lights')->nullable();
            $table->boolean('turn_signals')->nullable();
            $table->boolean('lube_higes')->nullable();
            $table->boolean('emergency_lights')->nullable();
            $table->boolean('rear_domes')->nullable();
            $table->boolean('washer_fluid')->nullable();
            $table->boolean('air_filter')->nullable();
            $table->boolean('oil_level')->nullable();
            $table->boolean('power_steering_level')->nullable();
            $table->boolean('brake_fluid_level')->nullable();
            $table->boolean('coolant_level')->nullable();
            $table->boolean('batteries')->nullable();
            $table->boolean('spare_tire')->nullable();
            $table->boolean('brakes')->nullable();
            $table->boolean('rotors')->nullable();
            $table->boolean('tires')->nullable();
            $table->boolean('torque_wheels')->nullable();
            $table->boolean('front_end')->nullable();
            $table->boolean('backup_beeper')->nullable();
            $table->boolean('stretcher')->nullable();
            $table->boolean('ebrake')->nullable();
            $table->boolean('body_damage')->nullable();
            $table->boolean('hvac')->nullable();
            $table->boolean('camera')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_tickets');
    }
}
