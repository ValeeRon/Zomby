<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesOfPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typesOfPlace', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('icon_id');
            $table->foreign('icon_id')->references('id')->on('icons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typesOfPlace');
    }
}
