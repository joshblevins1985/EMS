<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('classroom_id');
            $table->string('label');
            $table->integer('section_order');
            $table->boolean('required');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_room_sections');
    }
}
