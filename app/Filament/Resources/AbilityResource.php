<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbilityResource\Pages;
use App\Filament\Resources\AbilityResource\RelationManagers;
use App\Models\Ability;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AbilityResource extends Resource
{
    protected static ?string $model = Ability::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('level')
                    ->required()
                    ->numeric(),
                Forms\Components\MultiSelect::make('classes')
                    ->relationship('classes', 'name')
                    ->label('Класи, що мають цю здібність:')
                    ->placeholder('Виберіть класи...')
                    ->preload()
                    ->searchable(),
                Forms\Components\MultiSelect::make('races')
                    ->relationship('races', 'name')
                    ->label('Раси, що мають цю здібність:')
                    ->placeholder('Виберіть раси...')
                    ->preload()
                    ->searchable(),Forms\Components\MultiSelect::make('classes')
                    ->relationship('classes', 'name')
                    ->label('Класи, що мають цю здібність:')
                    ->placeholder('Виберіть класи...')
                    ->preload()
                    ->searchable(),
                Forms\Components\MultiSelect::make('races')
                    ->relationship('races', 'name')
                    ->label('Раси, що мають цю здібність:')
                    ->placeholder('Виберіть раси...')
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('name')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('level')
                        ->numeric()
                        ->sortable(),
                    Tables\Columns\TagsColumn::make('classes.name')
                        ->searchable()
                        ->separator(', '),
                    Tables\Columns\TagsColumn::make('races.name')
                        ->searchable()
                        ->separator(', '),
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
            'index' => Pages\ListAbilities::route('/'),
            'create' => Pages\CreateAbility::route('/create'),
            'edit' => Pages\EditAbility::route('/{record}/edit'),
        ];
    }
}
