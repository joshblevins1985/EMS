<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBucyrusVariancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucyrus_variances', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('incident_id', 10);
            $table->string('responded_from')->nullable();
            $table->string('variance_reason', 4)->nullable();
            $table->text('variance_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bucyrus_variances');
    }
}
