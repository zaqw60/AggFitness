<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            SkillSeeder::class,
            TagSeeder::class,
            RelationSeeder::class,
            SubscriptionSeeder::class,
            GymSeeder::class,
            GymAddressesSeeder::class,
            GymImagesSeeder::class,
            GymReviewsSeeder::class,
            TrainerReviewsSeeder::class,
            CharacteristicSeeder::class,
            ModeratingSeeder::class,
        ]);
    }
}
