<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NarcoticAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narcotic_audits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('narcotic_box_id', '10');
            $table->string('employee_id', '10');
            $table->string('audit_type', '10');
            $table->longText('comments')->nullable();
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
        Schema::dropIfExists('narcotic_audits');
    }
}
