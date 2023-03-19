<?php

namespace Database\Seeders;

use App\Models\Characteristic;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('characteristics')->insert($this->getData());
    }

    /**
     *
     * @return array
     */
    private function getData(): array
    {
        $characteristics = [];
        $healthGroups = [Characteristic::HEALTH_A, Characteristic::HEALTH_B, Characteristic::HEALTH_C];
        $faker = Factory::create('ru_RU');
        $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));

        for ($i = 38; $i < 56; $i++) {
            do {
                $city = $faker->city();
            } while ($city === 'Москва');
            if ($i % 2 === 0) {
                $city = 'Москва';
            }

            $characteristics[] = [
                'user_id'         => $i,
                'location'        => $city,
                'height'      => rand(155, 198),
                'weight'    => rand(60, 110),
                'health' => $healthGroups[rand(0, 2)],
                'description'     => 'С детства занимаюсь различными танцами, много времени посвящаю спорту. 
                Также увлекаюсь бегом, лыжами, театральным искусством: не только посещаю спектакли, 
                но и играю в любительских спектаклях, люблю этюды и акробатические номера.',
                'created_at'      => now('Europe/Moscow')
            ];
        }
        return $characteristics;
    }
}
