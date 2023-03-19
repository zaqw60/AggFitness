<?php

namespace Database\Seeders;

use App\Models\Role;
//use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert($this->getData());
    }

    /**
     *
     * @return array
     */
    private function getData(): array
    {
        $roles = [];

        // $faker = Factory::create('ru_RU');
        // $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));

        $roles[] = [
            'role'         => 'IS_ADMIN',
            'title'        => 'Администратор',
            'description'  => 'Вы администратор и мееете доступ к настройкам сайта',
            'created_at'   => now('Europe/Moscow')
        ];

        $roles[] = [
            'role'         => 'IS_TRAINER',
            'title'        => 'Тренер',
            'description'  => 'Вы тренер и хотите создать анкету с портфолио',
            'created_at'   => now('Europe/Moscow')
        ];

        $roles[] = [
            'role'         => 'IS_CLIENT',
            'title'        => 'Клиент сайта',
            'description'  => 'Вы клиент, ищете тренера, клуб, хотите оставить отзыв',
            'created_at'   => now('Europe/Moscow')
        ];

        $roles[] = [
            'role'         => 'IS_GYM',
            'title'        => 'Представитель фитнес-клуба',
            'description'  => 'Вы представитель фитнес-клуба, ваша цель - рекламная интеграция и сотрудничество',
            'created_at'   => now('Europe/Moscow')
        ];

        return $roles;
    }
}
