<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnrolledStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled_students', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('class_id');
            $table->string('user_id');
            $table->dateTime('completed');
            $table->string('status', '5');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolled_students');
    }
}
