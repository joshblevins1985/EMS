<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunSheetAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('run_sheet_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('brs_id','15');
            $table->string('old');
            $table->string('change');
            $table->string('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('run_sheet_audit');
    }
}
