<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCalandarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_calandars', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('start_time');
            $table->dateTime('end_date');
            $table->string('link')->nullable();
            $table->string('color')->nullable();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_calandars');
    }
}
