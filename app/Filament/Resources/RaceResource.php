<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaceResource\Pages;
use App\Filament\Resources\RaceResource\RelationManagers;
use App\Models\Ability;
use App\Models\Characteristic;
use App\Models\Language;
use App\Models\Proficiency;
use App\Models\Race;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RaceResource extends Resource
{
    protected static ?string $model = Race::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('images')
                    ->label('Зображення')
                    ->disk('public')
                    ->image()
                    ->responsiveImages(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(30),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('suggested_names')
                    ->maxLength(200),
                Forms\Components\TextInput::make('move_speed')
                    ->required()
                    ->numeric(),
                Select::make('languages')
                    ->required()
                    ->multiple()
//                    ->createOptionForm(Language::getForm())
                    ->searchable()
                    ->relationship('languages', 'name')
                    ->preload(),

                Select::make('abilities')
                    ->label('Доступні Вміння')
                    ->multiple()
//                    ->createOptionForm(Ability::getForm())
                    ->searchable()
                    ->relationship('abilities', 'name')
                    ->options(Ability::all()->pluck('name', 'id'))
                    ->preload(),

                Select::make('proficiencies')
                    ->label('Доступні Володіння')
                    ->multiple()
//                    ->createOptionForm(Proficiency::getForm())
                    ->searchable()
                    ->relationship('proficiencies', 'name')
                    ->options(Proficiency::all()->pluck('name', 'id'))
                    ->preload(),
                Forms\Components\TextInput::make('available_proficiency')
                    ->required()
                    ->default(0)
                    ->numeric(),

                Repeater::make('characteristics')
                    ->relationship('characteristics')
                    ->label('Характеристики')
                    ->schema([
                        Select::make('characteristic_id')
                            ->label('Характеристика')
                            ->options(Characteristic::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable(),

                        TextInput::make('value')
                            ->label('Значення')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10),
                    ])
                    ->createItemButtonLabel('Додати характеристику')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('images')
                    ->width(100)
                    ->height(100),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('suggested_names')
                    ->searchable(),
                Tables\Columns\TextColumn::make('move_speed')
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRaces::route('/'),
            'create' => Pages\CreateRace::route('/create'),
            'edit' => Pages\EditRace::route('/{record}/edit'),
        ];
    }
}
