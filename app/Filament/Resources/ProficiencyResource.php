<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProficiencyResource\Pages;
use App\Filament\Resources\ProficiencyResource\RelationManagers;
use App\Models\Characteristic;
use App\Models\Proficiency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProficiencyResource extends Resource
{
    protected static ?string $model = Proficiency::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Characteristics';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(20),
                Forms\Components\Select::make('characteristic_id')
                    ->required()
                    ->createOptionForm(Characteristic::getForm())
                    ->searchable()
                    ->relationship('characteristic', 'name')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('name')->searchable(),
                    Tables\Columns\TextColumn::make('characteristic.name')->searchable(),
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
            'index' => Pages\ListProficiencies::route('/'),
            'create' => Pages\CreateProficiency::route('/create'),
            'edit' => Pages\EditProficiency::route('/{record}/edit'),
        ];
    }
}
