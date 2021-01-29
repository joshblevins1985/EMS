<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCovidExposuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_exposures', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('employee_id');
            $table->string('reported_by');
            $table->dateTime('interview')->nullable();
            $table->dateTime('follow_up')->nullable();
            $table->boolean('exposed')->default(0);
            $table->boolean('gown')->default(0);
            $table->boolean('mask')->default(0);
            $table->boolean('goggles')->default(0);
            $table->boolean('gloves')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covid_exposures');
    }
}
