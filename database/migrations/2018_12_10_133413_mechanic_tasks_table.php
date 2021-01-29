<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MechanicTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mechanic_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('task', 5);
            $table->string('mechanic_assigned', 10)->nullable();
            $table->date('anticipated_start_date')->nullable();
            $table->date('aticipated_end_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status', 4);
            $table->string('estimated_cost');
            $table->string('actual_cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mechanic_tasks');
    }
}
