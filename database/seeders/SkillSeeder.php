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
            $achievements = null;
            $arrAchievements = [];
            $newArrAchievements = [];

            $skills_list = null;
            $arrSkills = [];
            $newArrSkills = [];
            do {
                $city = $faker->city();
            } while ($city === 'Москва');
            if ($i % 2 === 0) {
                $city = 'Москва';
            }

            /*achievements*/
            for ($e = 0; $e < rand(4, 8); $e++) {
                $arrAchievements[] = rand(0, count(config('skills.achievements')) - 1);
            }
            $newArrAchievements = array_unique($arrAchievements);
            foreach ($newArrAchievements as $item) {
                if (is_null($achievements)) {
                    $achievements = config('skills.achievements')[$item];
                } else {
                    $newItem = '. ' . config('skills.achievements')[$item];
                    $achievements = $achievements . $newItem;
                }
            }

            /*skills_list*/
            for ($s = 0; $s < rand(6, 10); $s++) {
                $arrSkills[] = rand(0, count(config('skills.skills_list')) - 1);
            }
            $newArrSkills = array_unique($arrSkills);
            foreach ($newArrSkills as $item) {
                if (is_null($skills_list)) {
                    $skills_list = config('skills.skills_list')[$item];
                } else {
                    $newItem = '. ' . config('skills.skills_list')[$item];
                    $skills_list = $skills_list . $newItem;
                }
            }

            /*building data*/
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
