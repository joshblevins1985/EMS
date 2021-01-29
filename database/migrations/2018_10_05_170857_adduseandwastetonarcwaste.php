<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Adduseandwastetonarcwaste extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('narcotic_waste_forms', function (Blueprint $table) {
            $table->string('used', '5');
            $table->string('waste', '5');
            $table->string('status', '4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('narcotic_waste_form', function (Blueprint $table) {
            //
        });
    }
}
