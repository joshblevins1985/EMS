<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addprotocolssections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocols', function (Blueprint $table) {
            $table->longText('gerneral_considerations')->nullable();
            $table->longText('patient_presentation')->nullable();
            $table->longText('emt_treatment')->nullable();
            $table->longText('aemt_treatment')->nullable();
            $table->longText('paramedic_treatment')->nullable();
            $table->longText('cct_treatment')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocols', function (Blueprint $table) {
            //
        });
    }
}
