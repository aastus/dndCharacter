<?php

namespace App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class Background extends Model {
    protected $fillable = ['name', 'description'];

    public function characters() {
        return $this->hasMany(Character::class);
    }

    public function proficiencies() {
        return $this->belongsToMany(Proficiency::class, 'background_proficiency');
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
