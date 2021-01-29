<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewNarcoticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narcotic_boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('station', '5');
            $table->string('box_number', '10');
            $table->string('rfid', '50')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('narcotic_boxes');
    }
}
