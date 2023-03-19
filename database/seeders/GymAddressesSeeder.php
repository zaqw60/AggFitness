<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GymAddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gym_addresses')->insert($this->getData());
    }

    public function getData(): array
    {
        $gym_addresses = [];
        $faker = Factory::create('ru_RU');
        $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));
        for ($i = 0; $i < 18; $i++) {
            do {
                $city = $faker->city();
            } while ($city === 'Москва');
            if ($i % 2 === 0) {
                $city = 'Москва';
            }

            for ($e = 0; $e < rand(1, 10); $e++) {
                if ($e % 3 == 0) {
                    $building = rand(1, 20);
                    $apartment = null;
                } elseif ($e % 5 == 0) {
                    $building = rand(1, 5);
                    $apartment = rand(1, 300);
                } else {
                    $building = null;
                    $apartment = rand(1, 300);
                }


                $gym_addresses[] = [
                    'gym_id' => $i + 1,
                    'index' => rand(100000, 999999),
                    'country' => 'Россия',
                    'city' => $city,
                    'street' => config('streets')[rand(0, count(config('streets')) - 1)],
                    'house_number' => rand(1, 200),
                    'building' => $building,
                    'floor' => rand(1, 30),
                    'apartment' => $apartment,
                    'created_at' => now('Europe/Moscow')
                ];
            }
        }
        return $gym_addresses;
    }
}
