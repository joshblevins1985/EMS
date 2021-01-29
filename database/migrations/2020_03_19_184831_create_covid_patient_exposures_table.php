<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCovidPatientExposuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_patient_exposures', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('patient_name');
            $table->date('date_of_birth')->nullable();
            $table->date('follow_up')->nullable();
            $table->date('transport_date');
            $table->string('pick_up', 300)->nullable();
            $table->string('drop_off', 300)->nullable();
            $table->boolean('patient_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covid_patient_exposures');
    }
}
