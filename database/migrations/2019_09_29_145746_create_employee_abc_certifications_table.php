<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAbcCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_abc_certifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('user_id', 10);
            $table->string('certification_tyoe', 5);
            $table->string('cert_number', 15)->nullable();
            $table->date('expiration');
            $table->string('verification')->nullable();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_abc_certifications');
    }
}
