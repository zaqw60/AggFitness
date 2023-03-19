<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('skills')->insert($this->getData());
    }

    /**
     *
     * @return array
     */
    private function getData(): array
    {
        $skills = [];

        $faker = Factory::create('ru_RU');
        $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));

        for ($i = 2; $i < 38; $i++) {
            do {
                $city = $faker->city();
            } while ($city === 'Москва');
            if ($i % 2 === 0) {
                $city = 'Москва';
            }
            /*achievements*/
            for ($e = 0; $e < rand(3, 8); $e++) {
                if ($e === 0) {
                    $achievements = config('skills.achievements')[rand(0, count(config('skills.achievements')) - 1)];
                }
                $item = '. ' . config('skills.achievements')[rand(0, count(config('skills.achievements')) - 1)];
                if ($item !== $achievements) {
                    $achievements = $achievements . $item;
                }
            }
            /*skills_list*/
            for ($s = 0; $s < rand(6, 10); $s++) {
                if ($s === 0) {
                    $skills_list = config('skills.skills_list')[rand(0, count(config('skills.skills_list')) - 1)];
                }
                $item = '. ' . config('skills.skills_list')[rand(0, count(config('skills.skills_list')) - 1)];
                if ($item !== $skills_list) {
                    $skills_list = $skills_list . $item;
                }
            }
            $skills[] = [
                'user_id'         => $i,
                'location'        => $city,
                'education'       => config('skills.education')[rand(0, count(config('skills.education')) - 1)],
                'experience'      => rand(1, 11),
                'achievements'    => $achievements,
                'skills_list'     => $skills_list,
                'description'     => config('skills.description')[$i - 2],
                'created_at'      => now('Europe/Moscow')
            ];
        }
        return $skills;
    }
}
