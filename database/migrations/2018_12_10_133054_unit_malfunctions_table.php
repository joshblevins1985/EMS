<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitMalfunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_malfunctions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('label');
            $table->string('atf', 5)->nullable();
            $table->string('estimated_costs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_malfunctions');
    }
}
