<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('date_to_send')->nullable();
            $table->string('send_to');
            $table->string('author')->nullable();
            $table->longText('content');
            $table->string('uploaded_by', 10);
            $table->string('status', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_blogs');
    }
}
