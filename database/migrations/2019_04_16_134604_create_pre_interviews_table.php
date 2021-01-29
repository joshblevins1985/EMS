<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_interviews', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('year_pdrive', 5)->nullable();
            $table->string('year_cdrive', 5)->nullable();
            $table->string('year_edrive', 5)->nullable();
            $table->string('emswork', 5)->nullable();
            $table->string('ems_years', 5)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_interviews');
    }
}
