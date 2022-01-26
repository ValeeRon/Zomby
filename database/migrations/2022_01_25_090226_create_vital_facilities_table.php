<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitalFacilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('type_of_place_id');
            $table->date('date_added');
            $table->point('location')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('is_safe_id');
            $table->timestamps();

            $table->foreign('type_of_place_id')->references('id')->on('typesOfPlace');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('is_safe_id')->references('id')->on('isSafe');
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
