<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCovidExposureNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_exposure_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('comment');
            $table->integer('added_by');
            $table->integer('pid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covid_exposure_notes');
    }
}
