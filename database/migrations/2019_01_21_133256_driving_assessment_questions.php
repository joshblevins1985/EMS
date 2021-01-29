<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DrivingAssessmentQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driving_assessment_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('question');
            $table->string('category', 2);
            $table->string('p', 3);
            $table->string('ni', 3);
            $table->string('f', 3);
            $table->string('na', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driving_assessment_questions');
    }
}
