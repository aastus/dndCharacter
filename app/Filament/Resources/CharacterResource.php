<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacterResource\Pages;
use App\Filament\Resources\CharacterResource\RelationManagers;
use App\Models\Alignment;
use App\Models\Background;
use App\Models\Character;
use App\Models\ClassModel;
use App\Models\Race;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                Forms\Components\TextInput::make('character_name')
                    ->required()
                    ->maxLength(40),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(40),
                Forms\Components\Select::make('class_id')
                    ->required()
                    ->createOptionForm(ClassModel::getForm())
                    ->searchable()
                    ->relationship('class', 'name')
                    ->preload(),
                Forms\Components\Select::make('race_id')
                    ->required()
                    ->createOptionForm(Race::getForm())
                    ->searchable()
                    ->relationship('race', 'name')
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
                    ->numeric(),
                Forms\Components\TextInput::make('armor_type')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('hit_points')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('plus_speed')
                    ->numeric(),
                Forms\Components\TextInput::make('traits')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('ideals')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('bonds')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('flaws')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('prehistory')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('inventory')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('goals')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('age')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('height')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('weight')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('eye_color')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('skin_color')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('hair_color')
                    ->maxLength(30),
                Forms\Components\TextInput::make('notes')
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('character_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('class_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('race_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('background_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alignment_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('level')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('armor_type')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hit_points')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plus_speed')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('traits')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ideals')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bonds')
                    ->searchable(),
                Tables\Columns\TextColumn::make('flaws')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prehistory')
                    ->searchable(),
                Tables\Columns\TextColumn::make('inventory')
                    ->searchable(),
                Tables\Columns\TextColumn::make('goals')
                    ->searchable(),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('height')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('eye_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('skin_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hair_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('notes')
                    ->searchable(),
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
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }
}
