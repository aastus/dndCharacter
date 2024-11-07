<?php

namespace App\Filament\Resources\CharacterResource\Pages;

use App\Filament\Resources\CharacterResource;
use App\Models\Alignment;
use App\Models\Background;
use App\Models\Character;
use App\Models\Characteristic;
use App\Models\ClassModel;
use App\Models\Proficiency;
use App\Models\Race;
use App\Models\Spell;
use Filament\Actions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Facades\FilamentView;
use Filament\Tables;
use Filament\Tables\Table;
use function Filament\Support\is_app_url;

class CreateCharacter extends CreateRecord
{
    protected static string $resource = CharacterResource::class;
    use CreateRecord\Concerns\HasWizard;
//
//    public function hasSkippableSteps(): bool
//    {
//        return true;
//    }

    protected function getSteps(): array
    {
        return [
                Forms\Components\Wizard\Step::make('Основна')
                    ->columns(2)
                    ->schema([
                        TextInput::make('character_name')
                            ->label('Character Name')
                            ->required()
                            ->maxLength(40)
                            ->hint(fn ($get) => $get('suggested_names') ? 'Suggested: ' . $get('suggested_names') : ''),
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(40),
                        Forms\Components\Select::make('class_id')
                            ->required()
                            ->createOptionForm(ClassModel::getForm())
                            ->searchable()
                            ->reactive()
                            ->relationship('class', 'name')
                            ->afterStateUpdated(function ($state, $get, $set) {
                                self::updateProficiencyList($get, $set);
                                self::updateSpellsList($get, $set);
                                self::setMaxHp($state, $set, $get);
                            })
                            ->preload(),
                        Forms\Components\Select::make('race_id')
                            ->label('Race')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->default(1)
                            ->relationship('race', 'name')
                            ->afterStateHydrated(fn($state, $set) => self::setSugNames($state, $set))
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                self::updateProficiencyList($get, $set);
                                self::setSugNames($state, $set);
                            }),
                        Forms\Components\Select::make('background_id')
                            ->required()
                            ->createOptionForm(Background::getForm())
                            ->searchable()
                            ->relationship('background', 'name')
                            ->preload(),
                        Forms\Components\Select::make('alignment_id')
                            ->required()
                            ->createOptionForm(Alignment::getForm())
                            ->searchable()
                            ->relationship('alignment', 'name')
                            ->preload(),
                        Forms\Components\TextInput::make('level')
                            ->required()
                            ->default(1)
                            ->afterStateUpdated(fn ($get, $set) => self::updateSpellsList($get, $set))
                            ->numeric(),
                    ])
                    ->afterValidation(function () {
                        $data = $this->form->getState();

                        $this->record = new ($this->getModel())($data);

                        $this->record->save();

                        $defaultCharacteristics = [];
                        for ($i = 1; $i <= 6; $i++) {
                            $defaultCharacteristics[$i] = ['value' => 10];  // 'value' - значення по замовчуванню
                        }
                        $this->record->characteristics()->sync($defaultCharacteristics);
                    }),
            // Друга вкладка — Персонаж Інфо
                    Forms\Components\Wizard\Step::make('Персонаж Інфо')
                        ->columns(2)
                        ->schema([
                            Forms\Components\Textarea::make('traits')
                                ->label('Traits')
                                ->maxLength(300),
                            Forms\Components\Textarea::make('ideals')
                                ->label('Ideals')
                                ->maxLength(300),
                            Forms\Components\Textarea::make('bonds')
                                ->label('Bonds')
                                ->maxLength(300),
                            Forms\Components\Textarea::make('flaws')
                                ->label('Flaws')
                                ->maxLength(300),
                            Forms\Components\Textarea::make('prehistory')
                                ->label('Prehistory')
                                ->maxLength(300),
                            Forms\Components\Textarea::make('goals')
                                ->label('Goals')
                                ->maxLength(300),
                            Forms\Components\Select::make('language_id')
                                ->multiple()
                                ->preload()
                                //                    ->createOptionForm(Characteristic::getForm())
                                ->searchable()
                                ->relationship('languages', 'name')
                                ->preload()
                                ->columnSpanFull(),
                        ])
                        ->afterValidation(function (callable $get) {
                            $data = $this->form->getState();
                            $this->record->update($data);
                            $this->record->languages()->sync($get('language_id') ?? []);
                        }),

            // Третя вкладка — Характеристики
                    Forms\Components\Wizard\Step::make('Характеристики')
                            ->schema([
                                TextInput::make('armor_type')
                                    ->label('КЗ')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(20)
                                    ->columnSpan(1),

                                TextInput::make('hit_points')
                                    ->label('ХП')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(fn ($get) => $get('max_hp'))
                                    ->columnSpan(1),

                                TextInput::make('plus_speed')
                                    ->label('Додаткова швидкість')
                                    ->numeric()
                                    ->maxValue(50)
                                    ->default(0)
                                    ->columnSpan(1),
                                Repeater::make('characteristics')
                                    ->relationship('characteristics')
                                    ->schema([
                                        Select::make('characteristic_id')
                                            ->label('')
                                            ->options(Characteristic::pluck('name', 'id'))
                                            ->disabled()
                                            ->columnSpan(1),

                                        TextInput::make('value')
                                            ->label('')
                                            ->required()
                                            ->reactive()
                                            ->afterStateHydrated(fn ($state, $set) => $set('bonus', round(($state-10)/2)))
                                            ->afterStateUpdated(fn ($state, $set)=> $set('bonus', round(($state-10)/2)))
                                            ->numeric()
                                            ->minValue(1)
                                            ->maxValue(20)
                                            ->columnSpan(1),

                                        TextInput::make('bonus')
                                            ->label('')
                                            ->disabled()
                                            ->columnSpan(1),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull()
                                    ->reorderable(false)
                                    ->deletable(false)
                                    ->addable(false)
                                    ->default(function () {
                                        $characteristics = Characteristic::all()->map(function ($characteristic) {
                                            return [
                                                'characteristic_id' => $characteristic->id,
                                                'characteristic_name' => $characteristic->name,
                                                'value' => 10
                                            ];
                                        });
                                        return $characteristics->values()->toArray();
                                    })
                                    ->afterStateUpdated(function ($state, $record, $get) {
                                        $characteristicData = collect($state)->mapWithKeys(function ($item) {
                                            return [$item['characteristic_id'] => ['value' => $item['value'] ?? 10]];
                                        })->toArray();
                                        $this->record->characteristics()->sync($characteristicData);
                                    }),
                            CheckboxList::make('proficiencies')
                                ->relationship(name: 'proficiencies', titleAttribute: 'name')
                                ->label('Володіння')
                                ->options(function (callable $get) {
                                    return Proficiency::whereIn('id', self::availableProficiencies($get('race_id'), $get('class_id')))
                                        ->pluck('name', 'id');
                                })
                                ->default(function (callable $get) {
                                    $savedProficiencies = $get('record')?->proficiencies->pluck('id')->toArray() ?? [];
                                    return $savedProficiencies;
                                })
                                ->reactive()
                                ->afterStateUpdated(function (callable $get, callable $set, $state) {
                                    $state = array_filter($state ?? [], fn($value) => $value != null);
                                    $maxProficiency = self::getTotalAvailableProficiency($get('race_id'), $get('class_id'));
                                    $selectedCount = count($state);

                                    if ($selectedCount > $maxProficiency) {
                                        array_pop($state);
                                        $selectedCount--;
                                    }

                                    $set('proficiencies', $state);
                                    $set('selectedProficiencyCount', $selectedCount);
                                })->columns(3),
                            TextInput::make('selectedProficiencyCount')
                                ->label('Вибрано з доступних')
                                ->extraInputAttributes(['readonly' => true]) // Робимо поле лише для читання
                                ->reactive()
                                ->suffix(function (callable $get) {
                                    $maxCount = self::getTotalAvailableProficiency($get('race_id'), $get('class_id'));
                                    return "з $maxCount";
                                }),
                        ])
                        ->afterValidation(function (callable $get) {
                            $data = $this->form->getState();

                            $this->record->update($data);

                            $selectedProficiencies = array_filter($get('proficiencies'), fn($value) => $value !== null);

                            $this->record->proficiencies()->sync($selectedProficiencies);
                        }),
            // Четверта вкладка — Зброя і Заклинання
                    Forms\Components\Wizard\Step::make('Зброя і Заклинання')
                        ->schema([
                            Forms\Components\Textarea::make('inventory')
                                ->label('Inventory')
                                ->maxLength(300),
                            Forms\Components\Select::make('weapon_id')
                                ->multiple()
                                ->preload()
                                //                    ->createOptionForm(Characteristic::getForm())
                                ->searchable()
                                ->relationship('weapons', 'name')
                                ->preload()
                                ->columnSpanFull(),
                            Forms\Components\Select::make('spell_id')
                                ->multiple()
                                ->preload()
                                ->relationship('spells', 'name')
                                //                    ->createOptionForm(Characteristic::getForm())
                                ->searchable()
                                ->options(function (callable $get) {
                                    return Spell::whereIn('id', self::availableSpels($get('class_id'), $get('level')))
                                        ->pluck('name', 'id');
                                })
                                ->preload()
                                ->columnSpanFull(),
                        ])
                        ->afterValidation(function (callable $get) {
                            $data = $this->form->getState();

                            $this->record->update($data);

                            $this->record->weapons()->sync($get('weapon_id') ?? []);
                            $this->record->spells()->sync($get('spell_id') ?? []);
                        }),

            // П’ята вкладка — Вигляд
                    Forms\Components\Wizard\Step::make('Вигляд')
                        ->columns(2)
                        ->schema([
                            Forms\Components\TextInput::make('age')
                                ->label('Age')
                                ->numeric(),
                            Forms\Components\TextInput::make('height')
                                ->label('Height')
                                ->numeric(),
                            Forms\Components\TextInput::make('weight')
                                ->label('Weight')
                                ->numeric(),
                            Forms\Components\TextInput::make('eye_color')
                                ->label('Eye Color')
                                ->maxLength(30),
                            Forms\Components\TextInput::make('skin_color')
                                ->label('Skin Color')
                                ->maxLength(30),
                            Forms\Components\TextInput::make('hair_color')
                                ->label('Hair Color')
                                ->maxLength(30),
                            Forms\Components\FileUpload::make('photo')
                                ->label('Photo')
                                ->image(),
                        ])
                        ->afterValidation(function () {
                            $data = $this->form->getState();

                            $this->record->update($data);
                        }),

            // Шоста вкладка — Нотатки
                    Forms\Components\Wizard\Step::make('Нотатки')
                        ->schema([
                            Forms\Components\Textarea::make('notes')
                                ->label('Notes')
                                ->maxLength(500),
                        ])
                        ->afterValidation(function () {
                            $data = $this->form->getState();

                            $this->record->update($data);
                        })
        ->columnSpanFull()
        ];
    }

    public function create(bool $another = false): void
    {
        $data = $this->form->getState();

        $this->record->update($data);

        $redirectUrl = $this->getRedirectUrl();

        $this->redirect($redirectUrl, navigate: FilamentView::hasSpaMode() && is_app_url($redirectUrl));
    }

    protected static function updateProficiencyList(callable $get, callable $set) {
        $raceId = $get('race_id') ?? null;
        $classId = $get('class_id') ?? null;

        $availableProficiencies = self::availableProficiencies($raceId, $classId);

        $set('proficiencies', collect($availableProficiencies)->pluck('id')->all());
    }


    protected static function availableProficiencies($raceId, $classId) {
        $race_prof = Race::find($raceId)?->proficiencies->pluck('id');
        $class_prof = ClassModel::find($classId)?->proficiencies->pluck('id');
        if($class_prof != null && $race_prof != null)
            return $race_prof->merge($class_prof);
        else if($class_prof != null)
            return $class_prof;
        else if($race_prof != null)
            return $race_prof;
        else
            return [];
    }

    protected static function getTotalAvailableProficiency($raceId, $classId) {
        return (Race::find($raceId)?->available_proficiency ?? 0) +
            (ClassModel::find($classId)?->available_proficiency ?? 0);
    }

    protected static function updateSpellsList(callable $get, callable $set) {
        $classId = $get('class_id') ?? null;
        $level = $get('level');
        $set('proficiencies', collect(self::availableSpels($classId, $level))->pluck('id')->all());
    }

    protected static function availableSpels($classId, $level) {
        $is_magic = (ClassModel::find($classId)->is_magic ?? 0) + 1;
        return ClassModel::find($classId)?->spells()->where('level', '<=', floor(($level - 1) / 2 * $is_magic) + 1)->pluck('id') ?? [];
    }

    protected static function setMaxHp($state, $set, $get){
        $max_hp = ClassModel::find($state)->hp_per_level ?? 1 * $get('level');
        $set('max_value', $max_hp);
        $set('hit_points', $max_hp);
    }
    protected static function setSugNames($state, $set){
        $race = Race::find($state);

        if ($race)
            $set('suggested_names', $race->suggested_names);
        else
            $set('suggested_names', null);
    }
}
