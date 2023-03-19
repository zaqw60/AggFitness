<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gyms')->insert($this->getData());
    }

    public function getData(): array
    {
        $title = [
            'Arriba-fit',
            'Spiritfitness',
            'Limefitness',
            'Fly-fitness',
            'Xfit',
            'Pluzhnikfitness',
            'Fitcitrus',
            'Sportres',
            'Sky-fitnes',
            'Desire-fitness',
            'Orange-fit',
            'Cosmosgroup',
            'WorldClass',
            'Neptun',
            'F-fitness',
            'Zebra',
            'Crocusfitness',
            'DDX-Fitness'

        ];

        $url = [
            'https://arriba-fit.ru/fitness/trenazhernyj-zal',
            'https://spiritfitness.ru/portfolio/fitnes-zal-rodina-gym/',
            'https://limefitness.club/group/trenazhernyy-zal/personalnaya-trenirovka/',
            'https://fly-fitness.ru/uslugi/trenazhernyj-zal',
            'https://www.xfit.ru/services/trenazhernyy-zal/',
            'https://pluzhnikfitness.ru/trenazhernyy-zal',
            'https://fitcitrus.ru/services/trenazhyornyj-zal/',
            'https://sportres.ru/projects/muzhskoy-zal-fitnes-tsentra-family-fitness/',
            'https://sky-fitnes.ru/trenazhernyj-zal',
            'https://desire-fitness.ru/fitnes-zal-na-meste-kinoteatra.html',
            'https://orange-fit.ru/trenazhernyj-zal',
            'https://novosibirsk.cosmosgroup.ru/ru/service/fitnes-zal-2',
            'https://special.worldclass-kgd.ru/trenazhernyy-zal/soft-fitnes-trenirovki-dlya-nachinayushchih',
            'https://sport.neptun.spb.ru/trenazhyernyy-zal.php',
            'https://www.f-fitness.ru/timetable/nasledie/bolshoj-zal-aerobiki',
            'https://zebra-butovo.ru',
            'https://crocusfitness.com/crocus-city',
            'https://www.ddxfitness.ru/'
        ];
        $domain = [
            '@gmail.com',
            '@yandex.ru',
            '@mail.ru',
            '@rambler.ru',
            '@bk.ru',
            '@inbox.ru',
        ];

        $gyms = [];

        $faker = Factory::create('ru_RU');
        $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));

        for ($i = 0; $i < count($title); $i++) {
            $phone_second = '+7 ' . '(9' . rand(10, 99) . ') ' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99);

            $gyms[] = [
                'user_id' => $i + 56,
                //'title'   => $faker->company(),
                'title' => $title[$i],
                'phone_main' => '+7 ' . '(9' . rand(10, 99) . ') ' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99),
                'phone_second' => $phone_second,
                'email' => mb_strtolower($title[$i] . $domain[rand(0, count($domain) - 1)]),
                'url' => $url[$i],
                'description' => config('gyms')[$i],
                'created_at' => now('Europe/Moscow')
            ];
        }

        return $gyms;
    }
}
