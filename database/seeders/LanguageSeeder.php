<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Language;


class LanguageSeeder extends Seeder {
    public function run() {
        $languages = [
            ['name' => 'Загальна'],
            ['name' => 'Ельфійська'],
            ['name' => 'Небесна'],
            ['name' => 'Елементалів'],
            ['name' => 'Грунгська'],
            ['name' => 'Інфернальна'],
            ['name' => 'Оркська'],
            ['name' => 'Драконяча'],
            ['name' => 'Гоблінська'],
            ['name' => 'Трі-крінська'],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
