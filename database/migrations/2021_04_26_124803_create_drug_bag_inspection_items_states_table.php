<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugBagInspectionItemsStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_bag_inspection_items_states', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('drugId');
            $table->integer('stateId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_bag_inspection_items_states');
    }
}
