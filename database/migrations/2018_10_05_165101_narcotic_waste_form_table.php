<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NarcoticWasteFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narcotic_waste_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('station', '10')->nullable();
            $table->string('attending', '10')->nullable();
            $table->string('driver', '10')->nullable();
            $table->string('patient_name', '50')->nullable();
            $table->string('transport')->nullable();
            $table->string('administration')->nullable();
            $table->string('box', '10')->nullable();
            $table->string('seal', '20')->nullable();
            $table->string('new_seal', '20')->nullable();
            $table->string('paramedic', '10')->nullable();
            $table->string('witness', '10')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('narcotic_waste_forms');
    }
}
