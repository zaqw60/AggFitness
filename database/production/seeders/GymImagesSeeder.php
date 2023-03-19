<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GymImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gym_images')->insert($this->getData());
    }
    public function getData(): array
    {
        $counter = 0;
        $gym_images = [];

        for ($i = 0; $i < 18; $i++) {
            for ($e = 0; $e < 4; $e++) {
                $gym_images[] = [
                    'gym_id' => $i + 1,
                    'image' => 'image/' . config('gymImages')[$counter],
                    'created_at' => now('Europe/Moscow')
                ];
                $counter++;
            }
        }
        return $gym_images;
    }
}
