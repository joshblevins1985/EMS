<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAptToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatch_incidents', function (Blueprint $table) {
            $table->dateTime('apt_time')->nullable();
            $table->string('callers_name', 15)->nullable();
            $table->string('address_2')->nullable();
            $table->string('incident_phone', 15)->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dispatch_incidents', function (Blueprint $table) {
            //
        });
    }
}
