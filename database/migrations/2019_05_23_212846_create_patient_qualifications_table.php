<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('patient_id', 15);
            $table->string('qualification');
            $table->string('added_by');
            $table->string('last_updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_qualifications');
    }
}
