<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDoctorCertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_doctor_certs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('patient_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('round_trip');
            $table->string('pick_up_address', 300);
            $table->string('drop_off_address', 300);
            $table->integer('number_of_transports');
            $table->string('procedure_code')->nullable();
            $table->string('modifier_1')->nullable();
            $table->string('modifier_2')->nullable();
            $table->string('physician_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_doctor_certs');
    }
}
