<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSealNumbersToNarcBox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('narcotic_boxes', function (Blueprint $table) {
            $table->string('seal', '20');
            $table->string('tamper_seal', '20');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('narcotic_boxes', function (Blueprint $table) {
            //
        });
    }
}
