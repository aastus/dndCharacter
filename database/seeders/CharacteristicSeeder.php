<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Characteristic;


class CharacteristicSeeder extends Seeder {
    public function run() {
        $characteristics = [
            ['name' => 'Сила'],
            ['name' => 'Спритність'],
            ['name' => 'Статура'],
            ['name' => 'Інтелект'],
            ['name' => 'Мудрість'],
            ['name' => 'Харизма'],
        ];

        foreach ($characteristics as $characteristic) {
            Characteristic::create($characteristic);
        }
    }
}
