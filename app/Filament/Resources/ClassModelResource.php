<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassModelResource\Pages;
use App\Filament\Resources\ClassModelResource\RelationManagers;
use App\Models\Ability;
use App\Models\ClassModel;
use App\Models\Proficiency;
use App\Models\Spell;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassModelResource extends Resource
{
    protected static ?string $model = ClassModel::class;

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
                    ->maxLength(20),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('hp_per_level')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_magic')
                    ->required(),
                Select::make('abilities')
                    ->label('Available Abilities')
                    ->multiple()
//                    ->createOptionForm(Ability::getForm())
                    ->searchable()
                    ->relationship('abilities', 'name')
                    ->options(Ability::all()->pluck('name', 'id'))
                    ->preload(),

                Select::make('spells')
                    ->label('Available Spells')
                    ->multiple()
//                    ->createOptionForm(Spell::getForm())
                    ->searchable()
                    ->relationship('spells', 'name')
                    ->options(Spell::all()->pluck('name', 'id'))
                    ->preload(),
                Forms\Components\TextInput::make('available_proficiency')
                    ->label('Available Proficiency Count')
                    ->required()
                    ->default(0)
                    ->numeric(),

                Select::make('proficiencies')
                    ->label('Available Proficiency')
                    ->multiple()
//                    ->createOptionForm(Proficiency::getForm())
                    ->searchable()
                    ->relationship('proficiencies', 'name')
                    ->options(Proficiency::all()->pluck('name', 'id'))
                    ->preload()
                    ->hintAction(fn (Select $component) => Action::make('select all')
                        ->action(fn () => $component->state(Proficiency::pluck('id')->toArray()))
                    ),
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
                Tables\Columns\TextColumn::make('hp_per_level')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_magic')
                    ->boolean(),
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
            'index' => Pages\ListClassModels::route('/'),
            'create' => Pages\CreateClassModel::route('/create'),
            'edit' => Pages\EditClassModel::route('/{record}/edit'),
        ];
    }
}
