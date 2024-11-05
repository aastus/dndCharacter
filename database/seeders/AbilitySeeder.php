<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Ability;


class AbilitySeeder extends Seeder {
    public function run() {
        $abillities = [
            [
                'name'          => 'Темний зір',
                'description'   => 'У Вас є гострі котячі почуття, особливо у темряві. На відстані 60 футів ви при тьмяному освітленні можете бачити так, ніби це яскраве освітлення, і в темряві так, ніби це тьмяне освітлення. У темряві ви не можете розрізняти кольори, лише відтінки сірого.',
                'level'         => 1,
            ],
            [
                'name'          => 'Котяча спритність',
                'description'   => 'Ваші рефлекси та спритність дозволяють вам рухатися зі збільшенням швидкості. Коли ви рухаєтеся в бою у свій хід, ви можете подвоїти швидкість до кінця ходу.',
                'level'         => 1,
            ],
            [
                'name'          => 'Перевертень',
                'description'   => 'Дія ви можете змінити свій зовнішній вигляд і голос або повернутися в природну форму. Ви не можете скопіювати зовнішній вигляд істоти, яку жодного разу не бачили, а також ви повертаєтеся у свою справжню форму після смерті.',
                'level'         => 1,
            ],
            [
                'name'          => 'Спадщина фей',
                'description'   => 'Ви робите з перевагою спаски від стану «зачарований», і вас неможливо магічно приспати.',
                'level'         => 1,
            ],
            [
                'name'          => 'Транс',
                'description'   => 'Ельфи не потребують сна. Натомість вони поринають у глибоку медитацію, перебуваючи в напівнесвідомому стані до 4 годин на добу (зазвичай таку медитацію називають трансом).',
                'level'         => 1,
            ],
            [
                'name'          => 'Задержка дыхания',
                'description'   => 'Вы можете задерживать дыхание до 1 часа.',
                'level'         => 1,
            ],
            [
                'name'          => 'Природна стійкість',
                'description'   => 'Ви отримуєте опір шкоди кислотою та отрутою, а також здійснюєте з перевагою спаски проти отруєння.',
                'level'         => 1,
            ],
            [
                'name'          => 'Пекельний опір',
                'description'   => 'Ви отримуєте опір шкоди вогнем.',
                'level'         => 1,
            ],
        ];

        foreach ($abillities as $abill) {
            Ability::create([
                'name' => $abill['name'],
                'description' => $abill['description'],
                'level' => $abill['level'],
            ]);
        }
    }
}