<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverHistoryTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_history_trackings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('original_value', 4)->nullable();
            $table->string('new_value', 4)->nullable();
            $table->string('note')->nullable();
            $table->string('updated_by', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_history_trackings');
    }
}
