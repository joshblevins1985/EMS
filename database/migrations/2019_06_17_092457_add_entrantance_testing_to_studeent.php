<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEntrantanceTestingToStudeent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scholarship_applications', function (Blueprint $table) {
            $table->string('reading', 4)->default(0);
            $table->string('emt', 4)->default(0);
            $table->string('math', 4)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scholarship_applicantions', function (Blueprint $table) {
            //
        });
    }
}
