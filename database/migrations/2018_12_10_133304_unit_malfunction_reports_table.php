<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitMalfunctionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_malfunction_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('unit', 10);
            $table->string('mileage', 20)->nullable();
            $table->string('added_by', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_malfunction_reports');
    }
}
