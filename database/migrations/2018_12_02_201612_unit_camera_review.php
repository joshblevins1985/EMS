<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitCameraReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_camera_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('unit_id', 5);
            $table->date('date_requested')->nullable();
            $table->date('date_reviewed')->nullable();
            $table->string('reason_reviewed', 5)->nullable();
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
        Schema::dropIfExists('unit_camera_reviews');
    }
}
