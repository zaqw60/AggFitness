<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert($this->getData());
    }

    /**
     *
     * @return array
     */
    private function getData(): array
    {
        $tags = [];

        $tagsArr = [
            'Персональный тренинг',
            'Силовой и функциональный тренинг',
            'Программы Less Mills',
            'Танцевальные программы',
            'Mind & Body',
            'Кардиотренинг',
            'Специальные программы',
            'Боевые искусства',
            'Программы Outdoor',
            'Игровые программы',
            'Водные программы',
            'Детский фитнес',
            'Крохи',
            'Малыши',
            'Почемучки',
            'Непоседы',
            'Юниоры',
            'Teen’s club',
            'Студии всестороннего развития ребенка',
            'Спортивные секции для детей',
            'Водные программы для детей',
            'Триатлон'
        ];

        for ($i = 0; $i < count($tagsArr); $i++) {
            $tags[] = [
                'tag' => $tagsArr[$i],
                'created_at' => now('Europe/Moscow')
            ];
        }

        return $tags;
    }
}
