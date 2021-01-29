<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewTablePolicies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('policy_number', '6');
            $table->string('title');
            $table->date('date_effective');
            $table->date('date_terminatied');
            $table->string('approved_by');
            $table->text('purpose');
            $table->string('scope');
            $table->longText('policy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policies');
    }
}
