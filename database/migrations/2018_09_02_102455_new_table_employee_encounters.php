<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewTableEmployeeEncounters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_encounters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('doi');
            $table->string('user_id', '10');
            $table->string('encounter_type', '4');
            $table->string('department', '4');
            $table->string('policy', '4');
            $table->string('follow_up', '2');
            $table->date('fu_date');
            $table->text('incident_report');
            $table->text('plan');
            $table->string('associated');
            $table->string('added_by');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_encounters');
    }
}
