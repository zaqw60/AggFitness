<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_id');
            $table->bigInteger('index');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->bigInteger('house_number');
            $table->string('building')->nullable();
            $table->string('floor');
            $table->string('apartment')->nullable();

            $table->foreign('gym_id')->references('id')->on('gyms')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gym_addresses');
    }
};
