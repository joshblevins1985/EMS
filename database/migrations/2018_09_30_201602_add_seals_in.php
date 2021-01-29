<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSealsIn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('narcotic_log', function (Blueprint $table) {
            $table->string('seal_in', '15')->nullable();
            $table->string('tamper_seal_in', '15')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('narcotic_log', function (Blueprint $table) {
            //
        });
    }
}
