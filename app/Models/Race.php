<?php

namespace App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class Race extends Model {
    protected $fillable = ['name', 'description', 'move_speed', 'suggested_names'];

    public function characters() {
        return $this->hasMany(Character::class);
    }

    public function abilities() {
        return $this->belongsToMany(Ability::class, 'race_ability');
    }

    public function languages() {
        return $this->belongsToMany(Language::class, 'race_language');
    }

    public function proficiencies() {
        return $this->belongsToMany(Proficiency::class, 'race_proficiency');
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(30),
            Textarea::make('description')
                ->required()
                ->columnSpanFull(),
            TextInput::make('suggested_names')
                ->maxLength(200),
            TextInput::make('move_speed')
                ->required()
                ->numeric(),
        ];
    }
}
