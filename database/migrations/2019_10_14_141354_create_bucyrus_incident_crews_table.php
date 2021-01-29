<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBucyrusIncidentCrewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucyrus_incident_crews', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('incident_id', 10);
            $table->string('user_id', 10);
            $table->string('assignment', 2);
            $table->string('level', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bucyrus_incident_crews');
    }
}
