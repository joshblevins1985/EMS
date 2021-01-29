<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewNarcoticLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narcotic_log', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('box', '10');
            $table->dateTime('time_out');
            $table->string('out_signature')->nullable();
            $table->dateTime('time_in')->nullable();
            $table->string('in_signature')->nullable();
            $table->string('unit', '8')->nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('narcotic_log');
    }
}
