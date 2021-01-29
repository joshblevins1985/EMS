<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWallJacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wall_jacks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('location_id');
            $table->string('identification');
            $table->integer('patch_panel_id')->nullable();
            $table->string('patch_panel_port')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wall_jacks');
    }
}
