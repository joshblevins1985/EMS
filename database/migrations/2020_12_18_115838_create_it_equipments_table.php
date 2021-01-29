<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('it_equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('manufacture');
            $table->string('make');
            $table->decimal('cost', $percision = 8, $scale =2);
            $table->string('vendor')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('it_equipments');
    }
}
