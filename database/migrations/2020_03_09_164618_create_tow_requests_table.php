<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTowRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tow_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('company_id')->nullable();
            $table->string('company_other', 50)->nullable();
            $table->string('pick_up_house_number', 10)->nullable();
            $table->string('pick_up_street', 75)->nullable();
            $table->string('pick_up_other', 191)->nullable();
            $table->string('pick_up_city', 75)->nullable();
            $table->string('pick_up_state', 50)->nullable();
            $table->string('pick_up_zip', 10)->nullable();
            $table->string('drop_off_house_number', 10)->nullable();
            $table->string('drop_off_street', 75)->nullable();
            $table->string('drop_off_other', 191)->nullable();
            $table->string('drop_off_city', 75)->nullable();
            $table->string('drop_off_state', 50)->nullable();
            $table->string('drop_off_zip', 10)->nullable();
            $table->integer('unit_id')->nullable();
            $table->string('year', 4)->nullable();
            $table->string('make', 20)->nullable();
            $table->string('model', 20)->nullable();
            $table->string('vin', 20 )->nullable();
            $table->string('license_plate', 10)->nullable();
            $table->string('license_plate_state', 50)->nullable();
            $table->decimal('start_miles', 5, 2)->unsigned()->default(000.00)->nullable();
            $table->decimal('ending_miles', 5, 2)->unsigned()->default(000.00)->nullable();
            $table->dateTime('dispatch_time')->nullable();
            $table->dateTime('enroute_time')->nullable();
            $table->dateTime('at_scene_time')->nullable();
            $table->dateTime('transport_time')->nullable();
            $table->dateTime('arrive_time')->nullable();
            $table->dateTime('clear_time')->nullable();
            $table->boolean('extra_persons')->default(0);
            $table->integer('reason_for_service')->nullable();
            $table->string('reason_for_service_other', 191)->nullable();
            $table->integer('extra_equipment')->nullable();
            $table->string('extra_equpment_other')->nullable();
            $table->integer('type_of_tow')->nullable();
            $table->integer('ordered_by')->nullable();
            $table->string('ordered_by_other', 191)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('authorised_person')->nullable();
            $table->string('vehicle_released_to')->nullable();
            $table->string('vehicle_released_to_dl')->nullable();
            $table->dateTime('authorized')->nullable();
            $table->dateTime('released')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tow_requests');
    }
}
