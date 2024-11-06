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
                'name'          => 'Затримка дихання',
                'description'   => 'Ви можете затримувати дихання до 1 години.',
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
            [
                'name'          => 'Голодна паща',
                'description'   => 'У битві Ви можете впасти в шаленство голодного хижака. Бонусною дією, Ви можете зробити спеціальну атаку укусом.',
                'level'         => 1,
            ],
            [
                'name'          => 'Вмілий ремісник',
                'description'   => 'Як частина короткого відпочинку, ви можете зібрати кістки і шкуру вбитого Звіра, Конструкту, Дракона, Монстра або Рослини розміром від Маленького і більше, щоб створити один з наступних предметів: щит, палиця, метальний спис, або 1к4 дротиків або голок для духової трубки.',
                'level'         => 1,
            ],


            [
                'name'          => 'Натхнення барда',
                'description'   => 'Ви можете надихати інших за допомогою музики або слів. Обране вами в межах 60 футів створіння отримує кістку натхнення (к6), яку може використати для додавання до перевірки характеристики, атаки або спаскидка протягом 10 хвилин.',
                'level'         => 1,
            ],
            [
                'name'          => 'Пісня відпочинку',
                'description'   => 'Під час короткого відпочинку ви допомагаєте союзникам відновити здоров\'я, надаючи додаткові 1к6 хітів при використанні Кісток Хітів.',
                'level'         => 2,
            ],
            [
                'name'          => 'Джерело натхнення',
                'description'   => 'Ви відновлюєте кістки натхнення після короткого та тривалого відпочинку.',
                'level'         => 5,
            ],
            [
                'name'          => 'Захист без обладунків',
                'description'   => 'Якщо ви не носите обладунків, ваш Клас Доспіху дорівнює 10 + модифікатор Ловкості + модифікатор Сили. Ви можете використовувати щит, зберігаючи цей бонус.',
                'level'         => 1,
            ],
            [
                'name'          => 'Лють',
                'description'   => 'Ви можете активувати Лють бонусною дією, отримуючи переваги для атак і спаскидок на Силу, бонус до ушкоджень та опір дроблячому, колючому та рублячому ушкодженню.',
                'level'         => 1,
            ],
            [
                'name'          => 'Безрозсудна атака',
                'description'   => 'Ви можете атакувати безрозсудно, отримуючи перевагу для атак, але надаючи ворогам перевагу на атаки проти вас до вашого наступного ходу.',
                'level'         => 2,
            ],
            [
                'name'          => 'Друге дихання',
                'description'   => 'Ви маєте обмежене джерело витривалості, яким можете скористатися, щоб уберегти себе. У свій хід ви можете бонусною дією відновити хіти у розмірі 1к10+ ваш рівень воїна. Використовуючи це вміння, ви повинні завершити короткий або тривалий відпочинок, щоб отримати можливість використовувати його знову.',
                'level'         => 1,
            ],
            [
                'name'          => 'Сплеск дій',
                'description'   => 'Ви маєте можливість на мить подолати звичайні можливості. У свій хід ви можете здійснити одну додаткову дію, крім звичайної та бонусної дій. Використовуючи це вміння, ви повинні завершити короткий або тривалий відпочинок, щоб отримати можливість використовувати його знову.',
                'level'         => 2,
            ],
            [
                'name'          => 'Додаткова атака',
                'description'   => 'Якщо ви в свій хід здійснюєте дію Атака, ви можете здійснити дві атаки замість однієї.',
                'level'         => 5,
            ],
            [
                'name'          => 'Магічне відновлення',
                'description'   => 'Ви знаєте, як відновлювати частину магічної енергії, вивчаючи книгу заклинань. Один раз на день, коли ви закінчуєте короткий відпочинок, ви можете відновити частину використаних осередків заклинань. Осередки заклинань можуть мати сумарний рівень, який не перевищує половину рівня вашого чарівника, і жодна з осередків не може бути шостого рівня або вищою.',
                'level'         => 1,
            ],
            [
                'name'          => 'Магічні традиції',
                'description'   => 'Ви вибираєте магічну традицію, яка визначає вашу магічну практику. Докладніше про всі традиції можна прочитати наприкінці опису класу.',
                'level'         => 2,
            ],
            [
                'name'          => 'Друїдська мова',
                'description'   => 'Друїдична мова — таємна мова друїдів. Ви можете говорити на ньому і залишати таємні послання. Ви та всі, хто знає цю мову, автоматично помічаєте ці послання. Інші помічають присутність послання при успішній перевірці Мудрості (Сприйняття) Сл ​​15, але без магії не можуть розшифрувати його.',
                'level'         => 1,
            ],
            [
                'name'          => 'Дикий вигляд',
                'description'   => 'Дією ви можете магічно прийняти вигляд будь-якого Звіра, якого ви бачили. Ви можете використовувати це вміння двічі, відновлюючи використання після короткого чи тривалого відпочинку. Рівень друїда визначає, на яких Звірів можна перетворюватися. Наприклад, на 2-му рівні можна перетворюватися на тварину з показником небезпеки не більше 1/4 без швидкості польоту та плавання.',
                'level'         => 2,
            ],
            [
                'name'          => 'Інфузування педмета',
                'description'   => 'Ви отримуєте здатність вливати у звичайні предмети певну магію та перетворювати їх на магічні.',
                'level'         => 2,
            ],
            [
                'name'          => 'Потрібний інструмент',
                'description'   => 'Ви навчилися створювати саме інструменти, які вам потрібні. За допомогою злодійських інструментів або інструментів ремісника можна чарівним чином створити один набір інструментів ремісника у вільному просторі в межах 5 футів від вас. Це вимагатиме 1 години безперервної роботи, яка може бути проведена під час короткого чи тривалого відпочинку. Хоча вони й створені за допомогою магії, самі інструменти немагічні та зникають, коли ви використовуєте це вміння.',
                'level'         => 3,
            ],
            [
                'name'          => 'Захист без обладунків',
                'description'   => 'Якщо ви не носите ні зброю, ні щит, ваш Клас Збруя дорівнює 10 + модифікатор Спритності + модифікатор Мудрості.',
                'level'         => 1,
            ],
            [
                'name'          => 'Ці',
                'description'   => 'Ваші тренування дозволяють вам керувати містичною енергією ци. Ваш доступ до цієї енергії виражається кількістю очок ци. Ваш рівень ченця визначає цю кількість, згідно з колонкою «Окуляри ци». Ви можете використовувати ці окуляри, щоб активувати різні вміння ці. Спочатку вам відомі наступні три вміння: «Надій вітру», «Терпляча оборона» і «Шквал ударів». З підвищенням рівня у цьому класі ви вивчите нові вміння ці.',
                'level'         => 2,
            ],
            [
                'name'          => 'Відбиття снарядів',
                'description'   => 'Ви можете реакцією відбити або спіймати снаряд, якщо по вас потрапили далекобійною атакою зброєю. Якщо ви робите це, шкода знижується на 1к10 + ваш модифікатор Спритності + ваш рівень ченця.',
                'level'         => 3,
            ],
            [
                'name'          => 'Накладання рук',
                'description'   => 'Ваше благословенне торкання може лікувати рани. У вас є запас лікувальної сили, що відновлюється після тривалого відпочинку. За допомогою цього запасу ви можете відновлювати кількість хітів, рівну рівню паладина, помноженому на 5. Ви можете дією торкнутися істоти і, зачерпнувши силу із запасу, відновити кількість хітів цієї істоти на будь-яке число, аж до максимуму, що залишився у вашому запасі.',
                'level'         => 1,
            ],
            [
                'name'          => 'Бойовий стиль',
                'description'   => 'Дуелянт: Поки ви тримаєте рукопашну зброю в одній руці, і не використовуєте іншу зброю, ви отримуєте бонус +2 до кидків збитків цією зброєю.Захист: Якщо істота, яку ви бачите, атакує не вас, а інша істота, яка знаходиться в межах 5 футів від вас, ви можете реакцією створити перешкоду його кидку атаки. Для цього ви маєте використовувати щит. Оборона: Поки ви носите зброю, ви отримуєте бонус +1 до КД.',
                'level'         => 2,
            ],
            [
                'name'          => 'Божественне здоров`я',
                'description'   => 'Божественна магія, що тече через вас, дає вам імунітет до хвороб.',
                'level'         => 3,
            ],
            [
                'name'          => 'Прихована атака',
                'description'   => 'Ви знаєте, як точно завдавати удару та використати відволікання ворога. Один раз в хід ви можете заподіяти додаткові 1к6 шкоди одному з істот, за яким ви потрапили атакою, скоєною з перевагою. Атака повинна використовувати далекобійну зброю або зброю з властивістю "фехтувальна". Вам не потрібно мати перевагу при кидку атаки, якщо інший ворог цілі знаходиться в межах 5 футів від неї. Цей ворог не повинен бути недієздатним, і у вас не повинно бути перешкод для кидка атаки.',
                'level'         => 1,
            ],
            [
                'name'          => 'Злодійський жаргон',
                'description'   => 'Під час шахрайського навчання ви вивчили злодійський жаргон, таємну суміш діалекту, жаргону та шифру, який дозволяє приховувати повідомлення у, здавалося б, звичайній розмові. Тільки інша істота, яка знає злодійський жаргон, розуміє такі повідомлення. Це займає вчетверо більше часу, ніж передача тих самих слів прямим текстом.',
                'level'         => 1,
            ],
            [
                'name'          => 'Хитра дія',
                'description'   => 'Ваше мислення та спритність дозволяють рухатися та діяти швидше. Ви можете в кожному своєму ході бою здійснювати бонусну дію. Ця дія може бути використана лише для Ривка, Відходу або Засідки.',
                'level'         => 2,
            ],
            [
                'name'          => 'Обраний ворог',
                'description'   => 'Ви маєте значний досвід вивчення, відстеження, полювання і навіть спілкування з певним видом ворогів. Ви здійснюєте з перевагою перевірки Мудрості (Виживання) для відстеження обраних ворогів, а також перевірки Інтелекту для згадування інформації про них.',
                'level'         => 1,
            ],
            [
                'name'          => 'Дослідник природи',
                'description'   => 'Ви дуже добре знайомі з одним видом природного середовища та маєте великий досвід подорожей та виживання в регіонах із таким кліматом. Виберіть один вид відомої місцевості: Арктика, болота, гори, ліси, луки, узбережжя, Підзем`я або пустеля. Коли ви здійснюєте перевірку Інтелекту або Мудрості, пов`язану з відомою вам місцевістю, ваш бонус майстерності подвоюється, якщо ви використовуєте навичку, якою володієте.',
                'level'         => 1,
            ],
            [
                'name'          => 'Первозданна поінформованість',
                'description'   => 'Ви можете дією витратити одну комірку заклинань слідопиту, щоб зосередитися на пізнанні простору навколо себе. Протягом 1 хвилини за кожний рівень використаного осередку заклинань ви можете відчути присутність наступних видів істот у межах 1 милі (або в межах 6 миль, якщо ви перебуваєте в обраній місцевості): Аберації, Дракони, Исчадія, Небожителі, Нежить, Феї та Елементалі. Це вміння не розкриває розташування та кількість істот.',
                'level'         => 3,
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
