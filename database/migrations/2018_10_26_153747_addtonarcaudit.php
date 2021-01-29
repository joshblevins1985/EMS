<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addtonarcaudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('narcotic_audits', function (Blueprint $table) {
            $table->longText('incident')->nullable();
            $table->string('narcotic_log_id', '10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('narcotic_audits', function (Blueprint $table) {
            //
        });
    }
}
