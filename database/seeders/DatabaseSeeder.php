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
            ProficiencySeeder::class,
            LanguageSeeder::class,
            AlignmentSeeder::class,
            AbilitySeeder::class,
            BackgroundSeeder::class,
            WeaponSeeder::class,
            SpellSeeder::class,
            RaceSeeder::class,
            ClassModelSeeder::class,
        ]);
    }
}
