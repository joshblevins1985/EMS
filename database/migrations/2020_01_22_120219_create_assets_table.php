<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('asset_tag', 25);
            $table->integer('type');
            $table->integer('location_id')->nullable();
            $table->integer('station_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->decimal('cost', 9, 2)->nullable();
            $table->integer('status')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
