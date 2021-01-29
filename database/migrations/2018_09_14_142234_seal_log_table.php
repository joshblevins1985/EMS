<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SealLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seal_log', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('seal', '20');
            $table->string('tamper_seal', '20')->nullable();
            $table->string('new_seal', '20')->nullable();
            $table->string('new_tamper_seal', '20')->nullable();
            $table->string('employee', '50');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seal_log');
    }
}
