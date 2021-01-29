<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomTopicTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_topic_trackings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('topic_id');
            $table->integer('user_id');
            $table->dateTime('completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classroom_topic_trackings');
    }
}
