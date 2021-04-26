<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugBagInspectionItemsLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_bag_inspection_items_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('drugId');
            $table->integer('levelId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_bag_inspection_items_levels');
    }
}
