<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('it_support_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('description')->nullable();
            $table->integer('asset_id')->nullable();
            $table->integer('reported_by')->nullable();
            $table->integer('user_id')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('it_support_tickets');
    }
}
