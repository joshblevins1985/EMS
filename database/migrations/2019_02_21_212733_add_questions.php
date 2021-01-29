<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('driving_assessments', function (Blueprint $table) {
            $table->string('q1', 4)->nullable();
            $table->string('q2', 4)->nullable();
            $table->string('q3', 4)->nullable();
            $table->string('q4', 4)->nullable();
            $table->string('q5', 4)->nullable();
            $table->string('q6', 4)->nullable();
            $table->string('q7', 4)->nullable();
            $table->string('q8', 4)->nullable();
            $table->string('q9', 4)->nullable();
            $table->string('q10', 4)->nullable();
            $table->string('q11', 4)->nullable();
            $table->string('q12', 4)->nullable();
            $table->string('q13', 4)->nullable();
            $table->string('q14', 4)->nullable();
            $table->string('q15', 4)->nullable();
            $table->string('q16', 4)->nullable();
            $table->string('q17', 4)->nullable();
            $table->string('q18', 4)->nullable();
            $table->string('q19', 4)->nullable();
            $table->string('q20', 4)->nullable();
            $table->string('q21', 4)->nullable();
            $table->string('q22', 4)->nullable();
            $table->string('q23', 4)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('driving_assessments', function (Blueprint $table) {
            //
        });
    }
}
