<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentQuizAnsweres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_quiz_answeres', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('student', 10);
            $table->string('question_id', 10);
            $table->string('answered', 10);
            $table->string('grade', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_quiz_answeres');
    }
}
