<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinancialFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financial_assistance_requests', function (Blueprint $table) {
            $table->string('school_contact')->nullable();
            $table->string('tax_agree')->nullable();
            $table->date('admin_date')->nullable();
            $table->date('doe_date')->nullable();
            $table->date('supervisor_date')->nullable();
            
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
