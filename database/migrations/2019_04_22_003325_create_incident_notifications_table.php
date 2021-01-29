<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('type', 15);
            $table->string('note')->nullable();
            $table->dateTime('read')->nullable();
            $table->string('read_by', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_notifications');
    }
}
