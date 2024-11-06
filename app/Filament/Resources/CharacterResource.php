<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacterResource\Pages;
use App\Filament\Resources\CharacterResource\RelationManagers;
use App\Models\Alignment;
use App\Models\Background;
use App\Models\Character;
use App\Models\Characteristic;
use App\Models\ClassModel;
use App\Models\Proficiency;
use App\Models\Race;
use App\Models\Spell;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CharacterResource extends Resource
{
    protected static ?string $model = Character::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
//        return $form
//            ->schema([
//                Forms\Components\TextInput::make('character_name')
//                    ->required()
//                    ->maxLength(40),
//                Forms\Components\TextInput::make('name')
//                    ->required()
//                    ->maxLength(40),
//                Forms\Components\TextInput::make('level')
//                    ->required()
//                    ->default(1)
//                    ->afterStateUpdated(fn ($get, $set) => self::updateSpellsList($get, $set))
//                    ->numeric(),
//                Forms\Components\TextInput::make('armor_type')
//                    ->required()
//                    ->numeric(),
//                Forms\Components\Select::make('class_id')
//                    ->required()
//                    ->createOptionForm(ClassModel::getForm())
//                    ->searchable()
//                    ->reactive()
//                    ->relationship('class', 'name')
//                    ->afterStateUpdated(function ($get, $set) {
//                        self::updateProficiencyList($get, $set);
//                        self::updateSpellsList($get, $set);
//                    })
//                    ->preload(),
//                Forms\Components\Select::make('race_id')
//                    ->required()
//                    ->createOptionForm(Race::getForm())
//                    ->searchable()
//                    ->reactive()
//                    ->relationship('race', 'name')
//                    ->afterStateUpdated(fn ($get, $set) => self::updateProficiencyList($get, $set))
//                    ->preload(),
//                Forms\Components\Select::make('background_id')
//                    ->required()
//                    ->createOptionForm(Background::getForm())
//                    ->searchable()
//                    ->relationship('background', 'name')
//                    ->preload(),
//                Forms\Components\Select::make('alignment_id')
//                    ->required()
//                    ->createOptionForm(Alignment::getForm())
//                    ->searchable()
//                    ->relationship('alignment', 'name')
//                    ->preload(),
//                Repeater::make('characteristics')
//                    ->relationship('characteristics')
//                    ->schema([
//                        Select::make('characteristic_id')
//                            ->label('')
//                            ->options(
//                                Characteristic::pluck('name', 'id')
//                            )
//                            ->required()
//                            ->disabled()
//                            ->preload()
//                            ->searchable()->columnSpan(1),
//
//                        TextInput::make('input_value') // поле для вводу значення
//                            ->label('')
//                            ->reactive() // активуємо оновлення при кожній зміні
//                            ->afterStateUpdated(fn ($state, $set)
//                                => $set('value', round(($state - 10) / 2))
//                            )->columnSpan(1), // оновлюємо calculated_value,
//
//                        TextInput::make('value') // розраховане значення
//                            ->label('')
//                            ->disabled() // зробимо недоступним для редагування
//                            ->required()
//                            ->columnSpan(1),
//                    ])
//                    ->columns(3) // встановлюємо розмір у три колонки
//                    ->columnSpanFull()
//                    ->reorderable(false)
//                    ->deletable(false)
//                    ->addable(false)
//                    ->default(function () {
//                        // Витягуємо всі характеристики і створюємо для кожної блок у Repeater
//                        $characteristics = Characteristic::all()->map(function ($characteristic) {
//                            return [
//                                'characteristic_id' => $characteristic->id,
//                                'characteristic_name' => $characteristic->name, // мапимо назву характеристики
//                                'input_value' => 10, // дефолтне значення
//                                'value' => 0, // дефолтне значення
//                            ];
//                        });
//                        return $characteristics->values()->toArray(); // Переконаємося, що повертається чистий масив
//                    }),
//
//                CheckboxList::make('proficiencies')
//                    ->label('Володіння')
//                    ->options(function (callable $get) {
//                        return Proficiency::whereIn('id', self::availableProficiencies($get('race_id'), $get('class_id')))
//                            ->pluck('name', 'id');
//                    })
//                    ->rules(function (callable $get) {
//                        $maxProficiency = self::getTotalAvailableProficiency($get('race_id'), $get('class_id'));
//                        return $maxProficiency > 0 ? ['max:' . $maxProficiency] : [];
//                    }),
//
//                Forms\Components\Select::make('weapon_id')
//                    ->multiple()
//                    ->preload()
////                    ->createOptionForm(Characteristic::getForm())
//                    ->searchable()
//                    ->relationship('weapons', 'name')
//                    ->preload()
//                    ->columnSpanFull(),
//                Forms\Components\Select::make('language_id')
//                    ->multiple()
//                    ->preload()
////                    ->createOptionForm(Characteristic::getForm())
//                    ->searchable()
//                    ->relationship('languages', 'name')
//                    ->preload()
//                    ->columnSpanFull(),
//                Forms\Components\Select::make('spell_id')
//                    ->multiple()
//                    ->preload()
////                    ->createOptionForm(Characteristic::getForm())
//                    ->searchable()
//                    ->options(function (callable $get) {
//                        return Spell::whereIn('id', self::availableSpels($get('class_id'), $get('level')))
//                            ->pluck('name', 'id');
//                    })
//                    ->preload()
//                    ->columnSpanFull(),
//                Forms\Components\TextInput::make('hit_points')
//                    ->required()
//                    ->numeric(),
//                Forms\Components\TextInput::make('plus_speed')
//                    ->numeric(),
//                Forms\Components\TextInput::make('traits')
//                    ->required()
//                    ->maxLength(300),
//                Forms\Components\TextInput::make('ideals')
//                    ->required()
//                    ->maxLength(300),
//                Forms\Components\TextInput::make('bonds')
//                    ->required()
//                    ->maxLength(300),
//                Forms\Components\TextInput::make('flaws')
//                    ->required()
//                    ->maxLength(300),
//                Forms\Components\TextInput::make('prehistory')
//                    ->required()
//                    ->maxLength(300),
//                Forms\Components\TextInput::make('inventory')
//                    ->required()
//                    ->maxLength(300),
//                Forms\Components\TextInput::make('goals')
//                    ->required()
//                    ->maxLength(300),
//                Forms\Components\TextInput::make('age')
//                    ->required()
//                    ->numeric(),
//                Forms\Components\TextInput::make('height')
//                    ->required()
//                    ->numeric(),
//                Forms\Components\TextInput::make('weight')
//                    ->required()
//                    ->numeric(),
//                Forms\Components\TextInput::make('eye_color')
//                    ->required()
//                    ->maxLength(30),
//                Forms\Components\TextInput::make('skin_color')
//                    ->required()
//                    ->maxLength(30),
//                Forms\Components\TextInput::make('hair_color')
//                    ->maxLength(30),
//                Forms\Components\TextInput::make('notes')
//                    ->maxLength(500),
//            ]);
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    // Перша вкладка — Основна
                    Forms\Components\Wizard\Step::make('Основна')
                        ->schema([
                            Forms\Components\TextInput::make('character_name')
                                ->label('Character name')
                                ->required()
                                ->maxLength(40),
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
                                ->afterStateUpdated(function ($get, $set) {
                                    self::updateProficiencyList($get, $set);
                                    self::updateSpellsList($get, $set);
                                })
                                ->preload(),
                            Forms\Components\Select::make('race_id')
                                ->required()
                                ->createOptionForm(Race::getForm())
                                ->searchable()
                                ->reactive()
                                ->relationship('race', 'name')
                                ->afterStateUpdated(fn ($get, $set) => self::updateProficiencyList($get, $set))
                                ->preload(),
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
                        ]),
                // Друга вкладка — Персонаж Інфо
                    Forms\Components\Wizard\Step::make('Персонаж Інфо')
                        ->schema([
                            Forms\Components\Textarea::make('traits')
                                ->label('Traits')
                                ->required()
                                ->maxLength(300),
                            Forms\Components\Textarea::make('ideals')
                                ->label('Ideals')
                                ->required()
                                ->maxLength(300),
                            Forms\Components\Textarea::make('bonds')
                                ->label('Bonds')
                                ->required()
                                ->maxLength(300),
                            Forms\Components\Textarea::make('flaws')
                                ->label('Flaws')
                                ->required()
                                ->maxLength(300),
                            Forms\Components\Textarea::make('prehistory')
                                ->label('Prehistory')
                                ->required()
                                ->maxLength(300),
                            Forms\Components\Textarea::make('goals')
                                ->label('Goals')
                                ->required()
                                ->maxLength(300),
                            Forms\Components\Select::make('language_id')
                                ->multiple()
                                ->preload()
                                //                    ->createOptionForm(Characteristic::getForm())
                                ->searchable()
                                ->relationship('languages', 'name')
                                ->preload()
                                ->columnSpanFull(),
                        ]),

                    // Третя вкладка — Характеристики
                    Forms\Components\Wizard\Step::make('Характеристики')
                        ->schema([
                            Repeater::make('characteristics')
                                ->relationship('characteristics')
                                ->schema([
                                    Select::make('characteristic_id')
                                        ->label('')
                                        ->options(
                                            Characteristic::pluck('name', 'id')
                                        )
                                        ->required()
                                        ->disabled()
                                        ->preload()
                                        ->searchable()->columnSpan(1),

                                    TextInput::make('input_value') // поле для вводу значення
                                    ->label('')
                                        ->reactive() // активуємо оновлення при кожній зміні
                                        ->afterStateUpdated(fn ($state, $set)
                                        => $set('value', round(($state - 10) / 2))
                                        )->columnSpan(1), // оновлюємо calculated_value,

                                    TextInput::make('value') // розраховане значення
                                    ->label('')
                                        ->disabled() // зробимо недоступним для редагування
                                        ->required()
                                        ->columnSpan(1),
                                ])
                                ->columns(3) // встановлюємо розмір у три колонки
                                ->columnSpanFull()
                                ->reorderable(false)
                                ->deletable(false)
                                ->addable(false)
                                ->default(function () {
                                    // Витягуємо всі характеристики і створюємо для кожної блок у Repeater
                                    $characteristics = Characteristic::all()->map(function ($characteristic) {
                                        return [
                                            'characteristic_id' => $characteristic->id,
                                            'characteristic_name' => $characteristic->name, // мапимо назву характеристики
                                            'input_value' => 10, // дефолтне значення
                                            'value' => 0, // дефолтне значення
                                        ];
                                    });
                                    return $characteristics->values()->toArray(); // Переконаємося, що повертається чистий масив
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
                                    $maxProficiency = self::getTotalAvailableProficiency($get('race_id'), $get('class_id'));
                                    $selectedCount = count(array_filter($state, fn($value) => $value !== null));

                                    if ($selectedCount > $maxProficiency) {
                                        array_pop($state);
                                        $selectedCount--;
                                        $set('proficiencies', $state);
                                    }

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
                        ]),

                    // Четверта вкладка — Зброя і Заклинання
                    Forms\Components\Wizard\Step::make('Зброя і Заклинання')
                        ->schema([
                            Forms\Components\Textarea::make('inventory')
                                ->label('Inventory')
                                ->required()
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
                                //                    ->createOptionForm(Characteristic::getForm())
                                ->searchable()
                                ->options(function (callable $get) {
                                    return Spell::whereIn('id', self::availableSpels($get('class_id'), $get('level')))
                                        ->pluck('name', 'id');
                                })
                                ->preload()
                                ->columnSpanFull(),
                        ]),

                    // П’ята вкладка — Вигляд
                    Forms\Components\Wizard\Step::make('Вигляд')
                        ->schema([
                            Forms\Components\TextInput::make('age')
                                ->label('Age')
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('height')
                                ->label('Height')
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('weight')
                                ->label('Weight')
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('eye_color')
                                ->label('Eye Color')
                                ->required()
                                ->maxLength(30),
                            Forms\Components\TextInput::make('skin_color')
                                ->label('Skin Color')
                                ->required()
                                ->maxLength(30),
                            Forms\Components\TextInput::make('hair_color')
                                ->label('Hair Color')
                                ->maxLength(30),
                            Forms\Components\FileUpload::make('photo')
                                ->label('Photo')
                                ->image(),
                        ]),

                    // Шоста вкладка — Нотатки
                    Forms\Components\Wizard\Step::make('Нотатки')
                        ->schema([
                            Forms\Components\Textarea::make('notes')
                                ->label('Notes')
                                ->maxLength(500),
                        ]),
                ])->columnSpanFull()->skippable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('character_name')->searchable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('level')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('race.name')->searchable(),
                Tables\Columns\TextColumn::make('class.name')->searchable(),
                Tables\Columns\TextColumn::make('alignment.name')->searchable(),
                Tables\Columns\TextColumn::make('background.name')->searchable(),
                Tables\Columns\TextColumn::make('armor_type')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hit_points')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Section::make('Main info')
                            ->schema([
                                TextEntry::make('character_name')
                                    ->label('Ім\'я персонажа')
                                    ->default(fn ($record) => $record->character_name),
                                TextEntry::make('class_name')
                                    ->label('Клас')
                                    ->default(fn ($record) => $record->class->name),
                                TextEntry::make('race_name')
                                    ->label('Раса')
                                    ->default(fn ($record) => $record->race->name),
                                TextEntry::make('background_name')
                                    ->label('Передісторія')
                                    ->default(fn ($record) => $record->background->name),
                                TextEntry::make('alignment_name')
                                    ->label('Світогляд')
                                    ->default(fn ($record) => $record->alignment->name),
                                TextEntry::make('player_name')
                                    ->label('Ім\'я гравця')
                                    ->default(fn ($record) => $record->name),
                                TextEntry::make('level')
                                    ->label('Рівень')
                                    ->default(fn ($record) => $record->level),
                            ])
                            ->columns(3)
                    ]),

                        Section::make('Additional info')
                            ->schema([
                                TextEntry::make('age')
                                    ->label('Age')
                                    ->default(fn ($record) => $record->age),
                                TextEntry::make('height')
                                    ->label('height')
                                    ->default(fn ($record) => $record->height),
                                TextEntry::make('weight')
                                    ->label('weight')
                                    ->default(fn ($record) => $record->weight),
                                TextEntry::make('eye_color')
                                    ->label('eye_color')
                                    ->default(fn ($record) => $record->eye_color),
                                TextEntry::make('skin_color')
                                    ->label('skin_color')
                                    ->default(fn ($record) => $record->skin_color),
                                TextEntry::make('hair_color')
                                    ->label('hair_color')
                                    ->default(fn ($record) => $record->hair_color),
                            ])->columns(3),

                Section::make('Статистика')
                    ->schema([
                        TextEntry::make('speed')
                            ->label('Швидкість')
                            ->default(fn ($record) => $record->class->move_speed + $record->plus_speed),
                        TextEntry::make('hit_points')
                            ->label('Хіти')
                            ->default(fn ($record) => $record->class->hp_per_level * $record->level),
                    ])
                    ->columns(2),

                Section::make('Характеристики')
                    ->schema(
                        fn ($record) => $record->characteristics->map(function ($characteristic) {
                            return TextEntry::make("characteristic_{$characteristic->id}")
                                ->label($characteristic->name)
                                ->default($characteristic->value);
                        })->toArray()
                    ),

                Section::make('Рятівні кидки')
                    ->schema(
                        fn ($record) => $record->characteristics->map(function ($characteristic) use ($record) {
                            return TextEntry::make("saving_throw_{$characteristic->id}")
                                ->label("Рят. кидок для {$characteristic->name}")
                                ->default(in_array($characteristic->id, $record->background->characteristics->pluck('id')->toArray()) ? 'Так' : 'Ні');
                        })->toArray()
                    ),

//                Section::make('Навички')
//                    ->schema(
//                        fn ($record) => $record->proficiencies->map(function ($proficiency) use ($record) {
//                            $bonus = $record->characteristics
//                                    ->where('id', $proficiency->characteristic_id)
//                                    ->first()->value + (($record->proficiencies->specialize ?? -1) + 1) * 2;
//
//                            return TextEntry::make("proficiency_{$proficiency->id}")
//                                ->label($proficiency->name)
//                                ->default($bonus);
//                        })->toArray()
//                    ),

                Section::make('Мови')
                    ->schema([
                        TextEntry::make('languages')
                            ->label('Мови')
                            ->default(fn ($record) => $record->languages
                                ->merge($record->race->languages)
                                ->pluck('name')
                                ->join(', ')
                            ),
                    ]),

                Section::make('Абілки')
                    ->schema([
                        TextEntry::make('abilities')
                            ->label('Абілки')
                            ->default(fn ($record) => $record->class->abilities
                                ->where('level', '<=', $record->level)
                                ->merge($record->race->abilities->where('level', '<=', $record->level))
                                ->pluck('name')
                                ->join(', ')
                            ),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
            'view' => Pages\ViewCharacter::route('/{record}'),
        ];
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
}
