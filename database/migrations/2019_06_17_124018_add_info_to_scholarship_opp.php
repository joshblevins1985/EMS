<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoToScholarshipOpp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scholarship_oppurtunities', function (Blueprint $table) {
            $table->date('end')->nullable();
            $table->string('address')->nullable();
            $table->string('cost', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scholarship_oppurtunities', function (Blueprint $table) {
            //
        });
    }
}
