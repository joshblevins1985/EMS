<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBucyrusIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucyrus_incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('unit_id');
            $table->string('street_number', 10)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('address2')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('township', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('patient', 50)->nullable();
            $table->time('call_time')->nullable();
            $table->time('dispatch_time')->nullable();
            $table->time('enroute_time')->nullable();
            $table->time('onscene_time')->nullable();
            $table->time('txp_time')->nullable();
            $table->time('txp_complete_time')->nullable();
            $table->time('clear_time')->nullable();
            $table->time('inservice_time')->nullable();
            $table->string('txp_facility', 10)->nullable();
            $table->string('street_number_txp', 10)->nullable();
            $table->string('street_txp', 100)->nullable();
            $table->string('address2_txp')->nullable();
            $table->string('city_txp', 100)->nullable();
            $table->string('state_txp', 50)->nullable();
            $table->string('zip_txp', 10)->nullable();
            $table->string('incident_type', 10);
            $table->string('incident_level', 10);
            $table->string('incident_call_type', 10);
            $table->string('incident_disposition', 10);
            $table->string('chute_calc', 10)->nullable();
            $table->string('response_calc', 10)->nullable();
            $table->string('onscene_calc', 10)->nullable();
            $table->string('txptime_calc', 10)->nullable();
            $table->string('toctxp_calc', 10)->nullable();
            $table->string('total_calc', 10)->nullable();
            $table->string('variance', 2)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bucyrus_incidents');
    }
}
