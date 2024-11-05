<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Background;
use App\Models\Proficiency;

class BackgroundSeeder extends Seeder {
    public function run() {
        $backgrounds = [
            [
                'name' => 'Артист',
                'description' => 'Людина мистецтва, яка розважає публіку і виконує різноманітні вистави.',
                'proficiencies' => ['Акробатика', 'Виступ'],
            ],
            [
                'name' => 'Мудрець',
                'description' => 'Вчена людина, яка збирає і зберігає знання.',
                'proficiencies' => ['Історія', 'Магія'],
            ],
            [
                'name' => 'Моряк',
                'description' => 'Ви багато років плавали на морському судні. Ви бачили могутчі шторма, глибоководних чудовищ і тех, хто хотів відправити вас на дно. Перша любов залишилася далеко за горизонтом, і настало час перевірити що-то нове.',
                'proficiencies' => ['Атлетика', 'Сприйняття'],
            ],
            [
                'name' => 'Благородний',
                'description' => 'Ви знаєте, що таке багатство, влада та привілеї. У вас благородний титул, а ваша сімя володіє землями, збирає податки, і має серйозний політичний вплив. Ви',
                'proficiencies' => ['Історія', 'Переконливість'],
            ],
            [
                'name' => 'Шарлатан',
                'description' => 'Ви добре знаєте людей. Ви розумієте, що ними рухає, і можете розпізнати їх найпотаємніші бажання всього через кілька хвилин після початку розмови.',
                'proficiencies' => ['Спритність рук', 'Обман'],
            ],
        ];

        foreach ($backgrounds as $data) {
            $background = Background::create([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);

            $proficiencyIds = Proficiency::whereIn('name', $data['proficiencies'])->pluck('id');
            $background->proficiencies()->attach($proficiencyIds);
        }
    }
}
