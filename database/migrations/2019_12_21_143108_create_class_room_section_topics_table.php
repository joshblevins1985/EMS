<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomSectionTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_section_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('section_id');
            $table->string('label');
            $table->text('instructions')->nullable();
            $table->integer('topic_order');
            $table->boolean('grade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_room_section_topics');
    }
}
