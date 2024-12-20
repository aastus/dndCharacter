<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Characteristic;
use App\Models\Proficiency;
use App\Models\Language;
use App\Models\Ability;
use App\Models\Race;


class RaceSeeder extends Seeder {
    public function run() {
        $races = [
            [
                'name'              => 'Табаксі',
                'description'       => 'Родом із дивних і далеких земель, мандрівні тютюни — кішкоподібні гуманоїди, яких цікавість змушує збирати цікаві артефакти, записувати розповіді та історії та оглядати всі дива у світі. Запеклі мандрівники, допитливі тютюни рідко надовго осідають на одному місці. Їхній вроджений характер штовхає їх розкривати таємниці та знаходити втрачені скарби та легенди.',
                'move_speed'        => 30,
                'suggested_names'   => 'Ліворука колібрі, Нефритовий черевик, Хмара на гірській вершині, Пять колод, Сім грозових хмар, Туманне дзеркало, Спідниця змії',
                'languages'         => ['Загальна'],
                'characteristics'   => [
                    'Спритність' => 2,
                    'Харизма' => 1,
                ],
                'abilities'         => ['Темний зір','Котяча спритність'],
                'available'         => 2,
                'proficiences'      => ['Сприйняття','Непомітність'],
            ],
            [
                'name'              => 'Ельф',
                'description'       => 'Ельфи - це чарівний народ, що володіє неземною витонченістю, що живе у світі, але не є його частиною. Вони живуть у місцях, наповнених повітряною красою, у глибинах стародавніх лісів або в срібних будинках, увінчаних блискучими шпилями та переливаються чарівним світлом. Там легкі подихи вітру розносять уривки тихих мелодій та ніжні аромати. Ельфи люблять природу та магію, музику та поезію, і все прекрасне, що є у світі.',
                'move_speed'        => 30,
                'suggested_names'   => 'Ара, Брін, Валь, Дель, Інніл, Адран, Араміль, Араніс, Ауст, Аеляр, Адріє, Альтеа, Анастріанна, Андрасте, Антінуа',
                'languages'         => ['Загальна', 'Ельфійська'],
                'characteristics'   => [
                    'Спритність' => 2,
                ],
                'abilities'         => ['Спадщина фей','Транс'],
                'available'         => 1,
                'proficiences'      => ['Сприйняття'],
            ],
            [
                'name'              => 'Людина',
                'description'       => 'У більшості світів люди – це наймолодша з найпоширеніших рас. Вони пізно вийшли на світову сцену і живуть набагато менше, ніж дварфи, ельфи та дракони. Можливо, саме стислість їхніх життів змушує їх прагнути досягти якнайбільшого у відведений їм термін. А можливо, вони хочуть щось довести старшим расам, і тому створюють могутні імперії, засновані на завоюваннях та торгівлі. Що б не рухало ними, люди завжди були інноваторами та піонерами у всіх світах.',
                'move_speed'        => 30,
                'suggested_names'   => 'Арізіма, Золіс, Муріті, Нефіс, Асеїр, Бардеїд, Зашеїр, Кхемед, Мехмен, Борівік, Владислак, Джандар, Канітар, Балама, Вонда, Джалана, Дона, Куара',
                'languages'                 => ['Загальна'],
                'characteristics'   => [
                    'Інтелект' => 1,
                ],
                'abilities'         => [''],
                'available'         => 0,
                'proficiences'      => [''],
            ],
            [
                'name'              => 'Ведалкен',
                'description'       => 'Ніщо не ідеальне. Ведалкени вірять у це та вихваляють це. Кожна недосконалість це шанс на поліпшення, і не важливо, що це закон або наука. Прогрес - це нескінченний похід у бік досконалості, якого ми можемо ніколи не досягти. Воно спонукає ведалкенов виконувати свою роботу з неймовірним ентузіазмом, ніколи не зупиняючись після невдачі та захоплюючись кожною можливістю для покращення.',
                'move_speed'        => 30,
                'suggested_names'   => 'Аглар, Беллін, Далід, Затаз, Йолов, Кевін, Коплоні, Ломар, Азі, Барвіска, Бразія, Дірелл, Грия, Зловов, Кетрілл, Ковел, Лілла',
                'languages'         => ['Загальна'],
                'characteristics'   => [
                    'Інтелект' => 2,
                    'Мудрість' => 1,
                ],
                'abilities'         => ['Затримка дихання'],
                'available'         => 1,
                'proficiences'      => ['Історія','Артистичність','Медицина','Магія','Розслідування','Спритність рук'],
            ],
            [
                'name'              => 'Мімік',
                'description'       => 'Чейнджлінги можуть змінювати свої обличчя та фігуру зі швидкістю думки. Багато чейнджлінг використовують це вміння для відображення своєї артистичності або вираження емоцій, проте це також неймовірно цінний інструмент для шахраїв, шпигунів, а також тих, хто хоче приховати свою особистість. Саме тому багато хто ставиться до чейнджлінгів зі страхом та підозрою.',
                'move_speed'        => 30,
                'suggested_names'   => 'Бін, Віл, Джин, Дос, Кас, Лам, Мас, Нікс, От, Пайк, Руз, Сім, Тукс, Фі, Харс, Південь',
                'languages' => ['Загальна'],
                'characteristics'   => [
                    'Харизма' => 2,
                ],
                'abilities'         => ['Перевертень'],
                'available'         => 2,
                'proficiences'      => ['Залякування','Обман','Переконливість','Проникливість'],
            ],
            [
                'name'              => 'Плазмоїд',
                'description'       => 'Плазмоїди – це аморфні істоти без певної форми. У присутності інших народів вони часто набувають схожої форми, проте дуже малий шанс переплутати плазмоїда з кимось іншим. Вони поглинають їжу за допомогою осмосу подібно до амеб, а відходи виділяють за допомогою крихітних пір. Вони дихають, поглинаючи кисень за допомогою інших пір, а їхні кінцівки сильні та гнучкі рівно настільки, щоб тримати та керувати зброєю чи інструментами. Незважаючи на те, що більшість плазмоїдів сірого кольору, вони можуть змінювати свій колір і ставати прозорими за допомогою поглинання барвників через пори.',
                'move_speed'        => 30,
                'suggested_names'   => 'Слі, Мака, Меба',
                'languages'         => ['Загальна'],
                'characteristics'   => [
                    'Статура' => 1,
                ],
                'abilities'         => ['Затримка дихання','Природна стійкість','Темний зір'],
                'available'         => 0,
                'proficiences'      => [''],
            ],
            [
                'name'              => 'Людиноящер',
                'description'       => 'Тільки дурень дивиться на людей і бачить не більше, ніж просто лускатих гуманоїдів. Незважаючи на їх фізичну форму, люди ящери мають більше спільного з ігуанами або драконами, ніж з людьми, дворфами або ельфами. Людоящери мають чужим і незбагненним чином думки, їх бажаннями і думками керує інший набір основних принципів, ніж істот із теплою кровю.',
                'move_speed'        => 30,
                'suggested_names'   => 'Аріт, Ачуак, Біешра, Варгач, Вертика, Вілігнат, Віт, Вута, Дарастрікс, Джанк, Гарурт, Ірхтос, Кепеск',
                'languages'         => ['Загальна', 'Драконяча'],
                'characteristics'   => [
                    'Статура' => 2,
                    'Мудрість' => 1,
                ],
                'abilities'         => ['Вмілий ремісник','Голодна паща'],
                'available'         => 2,
                'proficiences'      => ['Сприйняття','Природа','Виживання','Непомітність','Твариництво'],
            ],
            [
                'name'              => 'Тифлінг',
                'description'       => 'Бути тифлінгом означає постійно натикатися на пильні погляди і перешіптування, терпіти страждання і образи, бачити страх і недовіру в очах кожного зустрічного. Біда в тому, що тифлінги знають причину цього — договір, укладений багато поколінь тому і що дозволив Асмодею — владиці Дев`яти Пекла — зробити внесок у їхній родовід. Така зовнішність і природа — не їхня вина, а наслідок давньої гріхи, розплачуватися за яку належить їм, їхнім дітям, і дітям їхніх дітей.',
                'move_speed'        => 30,
                'suggested_names'   => 'Акменос, Амнон, Баракас, Дамакос, Йадос, Акта, Анакіс, Брісеїс, Дамая, Калліста, Кріелла',
                'languages'         => ['Загальна','Інфернальна'],
                'characteristics'   => [
                    'Інтелект' => 1,
                    'Харизма' => 2,
                ],
                'abilities'         => ['Пекельний опір','Темний зір'],
                'available'         => 0,
                'proficiences'      => [''],
            ],
        ];
        
        foreach ($races as $data) {
            $race = Race::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'move_speed' => $data['move_speed'],
                'suggested_names' => $data['suggested_names'],
                'available_proficiency' => $data['available'],
            ]);
        
            $langId = Language::whereIn('name', $data['languages'])->pluck('id');
            $race->languages()->attach($langId);
        
            foreach ($data['characteristics'] as $characteristicName => $value) {
                $characteristicId = Characteristic::where('name', $characteristicName)->value('id');
                $race->characteristics()->attach($characteristicId, ['value' => $value]);
            }

            if ($data['abilities'][0] !== '') {
                $abilityIds = Ability::whereIn('name', $data['abilities'])->pluck('id')->toArray();
                $race->abilities()->attach($abilityIds);
            }

            if ($data['proficiences'][0] !== '') {
                $proficiencyIds = Proficiency::whereIn('name', $data['proficiences'])->pluck('id')->toArray();
                $race->proficiencies()->attach($proficiencyIds);
            }
        }
    }
}
