<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugBagInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_bag_inspections', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('companyId');
            $table->integer('drugBagId');
            $table->integer('userId');
            $table->longText('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_bag_inspections');
    }
}
