<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTrainingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers_training_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('ftodate_id');
            $table->date('date_of_evaluation');
            $table->integer('employee_id');
            $table->integer('trainingOfficer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers_training_logs');
    }
}
