<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlignmentResource\Pages;
use App\Filament\Resources\AlignmentResource\RelationManagers;
use App\Models\Alignment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlignmentResource extends Resource
{
    protected static ?string $model = Alignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Background';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(25),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
            'index' => Pages\ListAlignments::route('/'),
            'create' => Pages\CreateAlignment::route('/create'),
            'edit' => Pages\EditAlignment::route('/{record}/edit'),
        ];
    }
}
