<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToScholarshipApps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scholarship_applications', function (Blueprint $table) {
            $table->text('goals')->nullable();
            $table->text('employment')->nullable();
            $table->text('activities')->nullable();
            $table->text('plans')->nullable();
            $table->longText('student_essay')->nullable();
            $table->string('middle_name', 25)->nullable();
            $table->string('preffered_name', 75)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scholarship_applications', function (Blueprint $table) {
            //
        });
    }
}
