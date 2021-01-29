<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinancialAssistanceFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financial_assistance_requests', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('school');
            $table->text('other_schools');
            $table->string('courses');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('cost', 6, 2);
            $table->text('imporove')->nullable();
            $table->text('pmt_plan')->nullable();
            $table->text('employee_signature')->nullable();
            $table->text('supervisor_signature')->nullable();
            $table->text('supervisor_user_id')->nullable();
            $table->text('director_signature')->nullable();
            $table->text('admin_user_id')->nullable();
            $table->text('admin_signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financial_assistance_requests', function (Blueprint $table) {
            //
        });
    }
}
