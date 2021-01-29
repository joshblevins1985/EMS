<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('year', 6)->nullable();
            $table->string('employer', 100)->nullable();
            $table->string('state', '50')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('pid', 10);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employment_histories');
    }
}
