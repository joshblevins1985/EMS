<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Driversriskassessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers_risk_assessment', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('age', 2);
            $table->string('sex', 2);
            $table->string('years_employed');
            $table->date('date_of_license');
            $table->string('shift_hours');
            $table->string('cognitive_exam',2);
            $table->string('employee_id', 10);
            $table->string('license_status', 4);
            $table->string('non_driver', 10);
            $table->string('corrective_lenses', 2);
            $table->string('medication', 2);
            $table->string('score', 10);
            $table->string('demo_score', 10);
            $table->string('mvr_score', 10);
            $table->string('history_score',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers_risk_assessment');
    }
}
