<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DrivingAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driving_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('employee_id', 15);
            $table->date('date_of_evaluation');
            $table->string('evaluator', 15);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('total_time');
            $table->string('reason_for_evaluation');
            $table->string('performance_rating');
            $table->text('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driving_assessments');
    }
}
