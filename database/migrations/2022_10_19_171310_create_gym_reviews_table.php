<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\GymReview;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('gym_id');

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gym_id')->references('id')->on('gyms')->onDelete('cascade');

            $table->string('title', 250);
            $table->text('description');
            $table->tinyInteger('score');
            $table->enum('status', [GymReview::ACTIVE, GymReview::BLOCKED, GymReview::DRAFT]);
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
        Schema::dropIfExists('gym_reviews');
    }
};
