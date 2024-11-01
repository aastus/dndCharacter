<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacteristicResource\Pages;
use App\Models\Characteristic;
use App\Models\Proficiency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CharacteristicResource extends Resource
{
    protected static ?string $model = Characteristic::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(20),

                Forms\Components\Select::make('proficiencies')
                    ->relationship('proficiencies', 'name')
                    ->label('Proficiencies')
                    ->multiple()
                    ->preload()
                    ->options(function () {
                        return Proficiency::pluck('name', 'id');
                    })
                    ->createOptionUsing(function ($data, $get) {
                        // Створюємо нову підкатегорію з ID поточної характеристики
                        return Proficiency::create([
                            'name' => $data['name'],
                            'characteristic_id' => $get('id'), // Отримання ID поточної характеристики
                        ])->id;
                    })
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Proficiency Name')
                            ->required(),
                    ])
                    ->searchable()
                    ->placeholder('Select or add proficiencies'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCharacteristics::route('/'),
            'create' => Pages\CreateCharacteristic::route('/create'),
            'edit' => Pages\EditCharacteristic::route('/{record}/edit'),
        ];
    }
}
