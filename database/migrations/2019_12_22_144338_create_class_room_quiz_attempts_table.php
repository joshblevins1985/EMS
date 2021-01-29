<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomQuizAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_quiz_attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('quiz_id');
            $table->integer('user_id');
            $table->integer('grade')->nullable();
            $table->dateTime('completed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_room_quiz_attempts');
    }
}
