<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Группы здоровья:
     * А – Возможны занятия физической культурой без ограничений и участие в соревнованиях.
     * B – Возможны занятия физической культурой с незначительными ограничениями физических нагрузок без участия в соревнованиях.
     * C - Возможны занятия физической культурой со значительными ограничениями физических нагрузок.
     * D – Возможны занятия только лечебной физкультурой.
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            $table->string('location', 150); //Город
            $table->integer('height'); //Рост
            $table->integer('weight'); //Вес
            $table->enum('health', [
                'A', 'B', 'C', 'D'
            ])->default('A'); //Группа по здоровью
            $table->text('description'); //О себе
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
        Schema::dropIfExists('characteristics');
    }
};
