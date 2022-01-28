<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitalFacility', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('type_of_place_id');
            $table->date('date_added');
            $table->double('location_x');
            $table->double('location_y');
            $table->unsignedBigInteger('is_safe');
            $table->timestamps();

            $table->foreign('type_of_place_id')->references('id')->on('typeOfPlace');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vitalFacilities');
    }
}
