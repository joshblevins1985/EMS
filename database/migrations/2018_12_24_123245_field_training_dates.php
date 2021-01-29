<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FieldTrainingDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_training_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('user_id', 10);
            $table->date('date');
            $table->string('total_hours');
            $table->string('training_officer')->nullable();
            $table->string('payroll', 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_training_dates');
    }
}
