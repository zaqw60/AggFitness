<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('profiles')->insert($this->getData());
    }

    /**
     *
     * @return array
     */
    private function getData(): array
    {
        $counter_t_f = 0;
        $counter_t_m = 0;
        $counter_c_f = 0;
        $counter_c_m = 0;
        $counter_g_f = 0;
        $counter_g_m = 0;
        $profiles = [];

        $faker = Factory::create('ru_RU');
        $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));

        for ($i = 2; $i < 38; $i++) {
            if ($i > 2 && $i % 3 === 0) {
                $profiles[] = [
                    'user_id' => $i,
                    'first_name' => $faker->firstNameFemale(),
                    'last_name' => $faker->lastName('female'),
                    'father_name' => config('profiles.female')[rand(0, count(config('profiles.female')) - 1)],
                    'age' => rand(25, 45),
                    'gender' => 'female',
                    'image' => 'image/' . config('photos.trainers.female')[$counter_t_f],
                    'created_at' => now('Europe/Moscow'),
                ];
                $counter_t_f++;
            } else {
                $profiles[] = [
                    'user_id' => $i,
                    'first_name' => $faker->firstNameMale(),
                    'last_name' => $faker->lastName('male'),
                    'father_name' => config('profiles.male')[rand(0, count(config('profiles.male')) - 1)],
                    'age' => rand(25, 45),
                    'gender' => 'male',
                    'image' => 'image/' . config('photos.trainers.male')[$counter_t_m],
                    'created_at' => now('Europe/Moscow'),
                ];
                $counter_t_m++;
            }
        }
        for ($i = 38; $i < 56; $i++) {
            if ($i % 3 === 0) {
                $profiles[] = [
                    'user_id' => $i,
                    'first_name' => $faker->firstNameFemale(),
                    'last_name' => $faker->lastName('female'),
                    'father_name' => config('profiles.female')[rand(0, count(config('profiles.female')) - 1)],
                    'age' => rand(25, 45),
                    'gender' => 'female',
                    'image' => 'image/' . config('photos.clients.female')[$counter_c_f],
                    'created_at' => now('Europe/Moscow'),
                ];
                $counter_c_f++;
            } else {
                $profiles[] = [
                    'user_id' => $i,
                    'first_name' => $faker->firstNameMale(),
                    'last_name' => $faker->lastName('male'),
                    'father_name' => config('profiles.male')[rand(0, count(config('profiles.male')) - 1)],
                    'age' => rand(25, 45),
                    'gender' => 'male',
                    'image' => 'image/' . config('photos.clients.male')[$counter_c_m],
                    'created_at' => now('Europe/Moscow'),
                ];
                $counter_c_m++;
            }
        }
        for ($i = 56; $i < 74; $i++) {
            if ($i % 3 === 0) {
                $profiles[] = [
                    'user_id' => $i,
                    'first_name' => $faker->firstNameFemale(),
                    'last_name' => $faker->lastName('female'),
                    'father_name' => config('profiles.female')[rand(0, count(config('profiles.female')) - 1)],
                    'age' => rand(25, 45),
                    'gender' => 'female',
                    'image' => 'image/' . config('photos.gyms.female')[$counter_g_f],
                    'created_at' => now('Europe/Moscow'),
                ];
                $counter_g_f++;
            } else {
                $profiles[] = [
                    'user_id' => $i,
                    'first_name' => $faker->firstNameMale(),
                    'last_name' => $faker->lastName('male'),
                    'father_name' => config('profiles.male')[rand(0, count(config('profiles.male')) - 1)],
                    'age' => rand(29, 42),
                    'gender' => 'male',
                    'image' => 'image/' . config('photos.gyms.male')[$counter_g_m],
                    'created_at' => now('Europe/Moscow'),
                ];
                $counter_g_m++;
            }
        }

        return $profiles;
    }
}
