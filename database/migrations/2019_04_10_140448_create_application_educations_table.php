<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('completed')->nullable();
            $table->string('school');
            $table->string('state');
            $table->string('degree');
            $table->string('application_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_educations');
    }
}
