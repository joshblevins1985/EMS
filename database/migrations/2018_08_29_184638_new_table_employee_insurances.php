<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewTableEmployeeInsurances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('user_id', '15');
            $table->string('insurance_id', '4');
            $table->date('start');
            $table->date('end');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_insurances');
    }
}
