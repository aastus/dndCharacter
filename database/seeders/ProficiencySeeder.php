<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Characteristic;
use App\Models\Proficiency;


class ProficiencySeeder extends Seeder {
    public function run() {
        $proficiencies = [
            ['name' => 'Історія',       'characteristic' => 'Інтелект'],
            ['name' => 'Акробатика',    'characteristic' => 'Спритність'],
            ['name' => 'Аналіз',        'characteristic' => 'Інтелект'],
            ['name' => 'Артистичність', 'characteristic' => 'Харизма'],
            ['name' => 'Атлетика',      'characteristic' => 'Сила'],
            ['name' => 'Сприйняття',    'characteristic' => 'Мудрість'],
            ['name' => 'Виживання',     'characteristic' => 'Мудрість'],
            ['name' => 'Залякування',   'characteristic' => 'Харизма'],
            ['name' => 'Медицина',      'characteristic' => 'Мудрість'],
            ['name' => 'Непомітність',  'characteristic' => 'Спритність'],
            ['name' => 'Обман',         'characteristic' => 'Харизма'],
            ['name' => 'Переконливість','characteristic' => 'Харизма'],
            ['name' => 'Твариництво',   'characteristic' => 'Мудрість'],
            ['name' => 'Природа',       'characteristic' => 'Інтелект'],
            ['name' => 'Проникливість', 'characteristic' => 'Мудрість'],
            ['name' => 'Релігія',       'characteristic' => 'Інтелект'],
            ['name' => 'Розслідування', 'characteristic' => 'Інтелект'],
            ['name' => 'Спритність рук','characteristic' => 'Спритність'],
            ['name' => 'Магія',         'characteristic' => 'Інтелект'],
        ];

        foreach ($proficiencies as $proficiency) {
            $characteristic = Characteristic::where('name', $proficiency['characteristic'])->first();
            if ($characteristic) {
                Proficiency::create([
                    'name' => $proficiency['name'],
                    'characteristic_id' => $characteristic->id,
                ]);
            }
        }
    }
}
