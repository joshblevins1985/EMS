<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScholarshipApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarship_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('student');
            $table->string('application')->nullable();
            $table->string('essay')->nullable();
            $table->string('school')->nullable();
            $table->string('oppurtunity_id')->nullable();
            $table->string('passed', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scholarship_applications');
    }
}
