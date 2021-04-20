<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugBagInspectionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_bag_inspection_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('companyId');
            $table->string('bagTypeId');
            $table->string('name');
            $table->string('arrayName');
            $table->integer('typeId');
            $table->boolean('statusId')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_bag_inspection_items');
    }
}
