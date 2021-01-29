<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimePunchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_punch', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps('');
            $table->string('employee_id')->index();
            $table->datetime('time_in')->nullable();
            $table->string('how_in', 2)->nullable();
            $table->datetime('time_out')->nullable();
            $table->string('how_out', 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('time_punch', function (Blueprint $table) {
            Schema::dropIfExists('time_punch');
        });
    }
}
