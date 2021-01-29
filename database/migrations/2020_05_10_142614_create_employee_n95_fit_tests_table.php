<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeN95FitTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_n95_fit_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->integer('tester');
            $table->integer('mask_type');
            $table->integer('test_type');
            $table->integer('proper_use')->default(0);
            $table->integer('understanding')->default(0);
            $table->integer('face_seal_check')->default(0);
            $table->integer('proper_disposal')->default(0);
            $table->integer('cleaning')->default(0);
            $table->integer('dentures')->default(0);
            $table->integer('facial_hair')->default(0);
            $table->integer('physical_exam')->default(0);
            $table->integer('glasses')->default(0);
            $table->string('limitatiions_other', 300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_n95_fit_tests');
    }
}
