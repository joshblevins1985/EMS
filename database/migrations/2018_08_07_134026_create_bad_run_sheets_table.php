<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadRunSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badrunsheets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('incident_date');
            $table->string('employee')->index();
            $table->string('pcr_number')->index();
            $table->string('status')->index();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badrunsheets');
    }
}
