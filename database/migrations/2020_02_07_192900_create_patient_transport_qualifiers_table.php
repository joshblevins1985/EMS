<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTransportQualifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_transport_qualifiers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('patient_id');
            $table->integer('transport_qualifier_id');
            $table->text('note');
            $table->date('expire');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_transport_qualifiers');
    }
}
