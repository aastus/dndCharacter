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
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    // Перша вкладка — Основна
                    Forms\Components\Wizard\Step::make('Основна')
                        ->schema([
                            Forms\Components\TextInput::make('character_name')
                                ->label('Character name')
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
                                ->afterStateHydrated(fn ($state, $set, $get) => self::setMaxHp($state, $set, $get))
                                ->afterStateUpdated(function ($state, $get, $set, $record) {
                                    self::updateProficiencyList($get, $set);
                                    self::updateSpellsList($get, $set);
                                    self::setMaxHp($state, $set, $get);
                                    $record->proficiencies()->sync([]);
                                    $record->spells()->sync([]);
                                })
                                ->preload(),
                            Forms\Components\Select::make('race_id')
                                ->label('Race')
                                ->required()
                                ->createOptionForm(Race::getForm())
                                ->searchable()
                                ->reactive()
                                ->default(1)
                                ->relationship('race', 'name')
                                ->afterStateUpdated(function ($state, $get, $set) {
                                    self::updateProficiencyList($get, $set);
                                    self::setSugNames($state, $set);
                                })
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
                            TextInput::make('armor_type')
                                ->label('Armor Type')
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(20)
                                ->columnSpan(1),

                            TextInput::make('hit_points')
                                ->label('Hit points')
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(fn ($get) => $get('max_hp'))
                                ->columnSpan(1),

                            TextInput::make('plus_speed')
                                ->label('Plus Speed')
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
                                                return [$item['characteristic_id'] => ['value' => $item['value']]];
                                            })->toArray();
                                            $record->characteristics()->sync($characteristicData);
                                        }),

                            CheckboxList::make('proficiencies')
                                ->relationship(name: 'proficiencies', titleAttribute: 'name')
                                ->label('Proficiency')
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
                                ->label('Selected from available')
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
                                ->relationship('spells', 'name')
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
//            ->query(function (Builder $query) {
//                if (auth()->check() && auth()->user()->hasRole('super_admin')) {
//                    return $query;
//                }
//
//                return $query->where('user_id', auth()->id());
//            })
            ->query(
                auth()->check() && auth()->user()->hasRole('super_admin')
                    ? \App\Models\Character::query()
                    : \App\Models\Character::where('user_id', auth()->id())
            )
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
                        TextEntry::make('hp')
                            ->label('Хіти')
                            ->default(fn ($record) => $record->hit_points . ' | ' . $record->class->hp_per_level * $record->level),
                        TextEntry::make('armor_type')
                            ->label('Armor Type')
                            ->default(fn ($record) => $record->armor_type),
                        TextEntry::make('speed')
                            ->label('Speed')
                            ->default(fn ($record) => $record->race->move_speed + $record->plus_speed),
                    ])
                    ->columns(3),

                Section::make('Характеристики')
                    ->schema(
                        fn ($record) => $record->characteristics->map(function ($characteristic) {
                            return TextEntry::make("characteristic_{$characteristic->id}")
                                ->label($characteristic->name . ' => ' . $characteristic->pivot->value);
                        })->toArray()
                    ),

                Section::make('Рятівні кидки')
                    ->schema(
                        fn ($record) => $record->characteristics->map(function ($characteristic) use ($record) {
                            return TextEntry::make("saving_throw_{$characteristic->id}")
                                ->label("Рят. кидок для {$characteristic->name}")
                                ->default(in_array($characteristic->id, $record->class->savingthrows->pluck('id')->toArray()) ? 'Так' : 'Ні');
                        })->toArray()
                    ),

                Section::make('Навички')
                    ->schema(
                        fn($record) => Proficiency::all()->map(function ($proficiency) use ($record) {
                            $existingProficiency = $record->proficiencies->firstWhere('id', $proficiency->id);

                            $characteristicBonus = $record->characteristics
                                ->where('id', $proficiency->characteristic_id)
                                ->first()->pivot->value;

                            $prof = $existingProficiency != null;
                            $spec = ($prof ?  $existingProficiency->pivot->specialize : -1);

                            $bonus = round( ($characteristicBonus - 10) / 2) + ($spec + 1) * 2;

                            return TextEntry::make("proficiency_{$proficiency->id}")
                                ->label($proficiency->name . ($prof ? '+' : ''))
                                ->default($bonus)
                                ->extraAttributes([
                                    'class' => $prof ? ($spec > 0 ? 'bg-gray-200' : 'bg-gray-400') : 'inherit',
                                ]);
                        })->toArray()
                    ),

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

                Section::make('Зброя')
                    ->schema(
                        fn ($record) => $record->weapons->map(function ($weapon) use ($record) {
                            $char = $record->characteristics
                                ->where('id', $weapon->characteristic_id)
                                ->first();

                            return TextEntry::make("weapons_{$weapon->id}")
                                ->label($weapon->name . ' => 1d' . $weapon->damage . ' ' . $char->name . ' +' . floor(($char->pivot->value- 10) / 2));
                        })->toArray()
                    ),

                Section::make('Заклинання')
                    ->schema(
                        fn ($record) => $record->spells
                            ->sortBy('level')
                            ->map(function ($spell) {
                                return TextEntry::make("spells_{$spell->id}")
                                    ->label($spell->name . ' => ' . ($spell->level ? ($spell->level . ' рівень') : ' заговір'));
                            })
                            ->toArray()
                    ),
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
        $set('spells', collect(self::availableSpels($classId, $level))->pluck('id')->all());
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
