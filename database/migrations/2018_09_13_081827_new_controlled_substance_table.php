<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewControlledSubstanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controlled_substances', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('medication', '4')->nullable();
            $table->string('lot_number', '10')->nullable();
            $table->date('expiration')->nullable();
            $table->string('location','4')->nullable();
            $table->string('dose', '6')->nullable();
            $table->string('status', '2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('controlled_substances');
    }
}
