<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ShieldSeeder::class,
            CharacteristicSeeder::class,
            LanguageSeeder::class,
            AlignmentSeeder::class,
            ProficiencySeeder::class,
            BackgroundSeeder::class,
            WeaponSeeder::class,
            RaceSeeder::class,
            ClassModelSeeder::class,
            AbilitySeeder::class,
            SpellSeeder::class,
        ]);
    }
}
