<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToCprClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cpr_classes', function (Blueprint $table) {
            $table->string('is_contract', '2');
            $table->string('address')->nullable();
            $table->string('city', '50')->nullable();
            $table->string('state', '50')->nullable();
            $table->string('zip', '10')->nullable();
            $table->string('email')->nullable();
            $table->string('payment_status','4')->nullable();
            $table->string('instructor','10')->nullable();
            $table->string('status', '4');
            $table->string('added_by');
            $table->string('last_updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cpr_classes', function (Blueprint $table) {
            //
        });
    }
}
