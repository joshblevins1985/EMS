<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Adquestionstoqa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qaqi', function (Blueprint $table) {
            $table->string('q1', 5)->nullable();
            $table->string('q2', 5)->nullable();
            $table->string('q3', 5)->nullable();
            $table->string('q4', 5)->nullable();
            $table->string('q5', 5)->nullable();
            $table->string('q6', 5)->nullable();
            $table->string('q7', 5)->nullable();
            $table->string('q8', 5)->nullable();
            $table->string('q9', 5)->nullable();
            $table->string('q10', 5)->nullable();
            $table->string('percent', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qaqi', function (Blueprint $table) {
            //
        });
    }
}
