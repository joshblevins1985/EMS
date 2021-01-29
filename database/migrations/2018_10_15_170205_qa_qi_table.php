<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QaQiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qaqi', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('employee_id', '15');
            $table->string('location');
            $table->string('protocol', '4')->nullable();
            $table->string('grade', '2');
            $table->longText('comments');
            $table->string('added_by', '15');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qaqi');
    }
}
