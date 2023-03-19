<?php

use App\Models\Moderating;
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
        Schema::create('moderatings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum(
                'status',
                [
                    Moderating::IS_PENDING,
                    Moderating::IS_APPROVED,
                    Moderating::IS_REJECTED
                ]
            )
                ->default(Moderating::IS_PENDING);
            $table->enum(
                'reason',
                [
                    Moderating::REASON00,
                    Moderating::REASON01,
                    Moderating::REASON02,
                    Moderating::REASON03,
                    Moderating::REASON04,
                    Moderating::REASON05
                ]
            )
                ->default(Moderating::REASON00);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('moderatings');
    }
};
