<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourseDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('class_id');
            $table->date('course_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('added_by')->nullable();
            $table->string('instructor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_dates');
    }
}
