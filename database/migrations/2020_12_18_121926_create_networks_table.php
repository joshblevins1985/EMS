<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('networks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('station');
            $table->string('subnet');
            $table->string('ip_start');
            $table->string('ip_end');
            $table->string('static_ip_start')->nullable();
            $table->string('static_ip_end')->nullable();
            $table->string('subnet_mask');
            $table->string('default_gateway');
            $table->string('isp');
            $table->string('isp_username')->nullable();
            $table->string('isp_password')->nullable();
            $table->string('isp_security')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('networks');
    }
}
