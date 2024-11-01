<?php

namespace App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Alignment extends Model {
    protected $fillable = ['name', 'description'];

    public $timestamps = false;

    public function characters() {
        return $this->hasMany(Character::class);
    }

    public static function getForm()
    {
        return [
           TextInput::make('name')
                ->required()
                ->maxLength(25),
           Textarea::make('description')
                ->required()
                ->columnSpanFull(),
        ];
    }
}
