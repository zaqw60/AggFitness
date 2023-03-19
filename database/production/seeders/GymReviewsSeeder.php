<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GymReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gym_reviews')->insert($this->getData());
    }

    /**
     *
     * @return array
     */
    private function getData(): array
    {
        $gymReviews = [];

        $faker = Factory::create('ru_RU');
        $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));
        for ($i = 0; $i < 18; $i++) {
            for ($e = 0; $e < rand(6, 25); $e++) {
                $gymReviews[] = [
                    'client_id' => rand(38, 55),
                    'gym_id' => $i + 1,
                    'title' => config('gymReviews')[rand(0, count(config('gymReviews')) - 1)]['title'],
                    'description' => config('gymReviews')[rand(0, count(config('gymReviews')) - 1)]['description'],
                    'score' => rand(4, 5),
                    'status' => 'ACTIVE',
                    'created_at'  => now('Europe/Moscow')
                ];
            }
        }
        return $gymReviews;
    }
}
