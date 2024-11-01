<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static bool $shouldSkipAuthorization = true;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Users';

    protected static ?string $navigationGroup = 'Filament Shield';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn($record) => $record === null)
                    ->maxLength(255)
                    ->minLength(8)
                    ->dehydrateStateUsing(fn($state) => bcrypt($state)),

                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label('Roles')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->sortable()
                    ->searchable()
                    ->badge()
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->label('Role'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Якщо є відношення, наприклад, профіль або інші таблиці, вони можуть бути додані тут
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
