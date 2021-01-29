<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VialLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vial_log', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('vial_id', '10');
            $table->string('status', '10');
            $table->text('comment');
            $table->string('added_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vial_log');
    }
}
