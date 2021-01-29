<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugBagSealLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_bag_seal_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('bag_id');
            $table->dateTime('time_out')->nullable();
            $table->string('out_signature')->nullable();
            $table->dateTime('in_signature')->nullable();
            $table->integer('seal')->nullable();
            $table->integer('new_seal')->nullable();
            $table->integer('new_seal_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_bag_seal_logs');
    }
}
