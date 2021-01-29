<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('classroom_id');
            $table->integer('topic_id')->nullable();
            $table->integer('category_id');
            $table->string('label');
            $table->integer('available_points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_room_grades');
    }
}
