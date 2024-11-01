<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model {
    protected $fillable = ['name'];

    public $timestamps = false;

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_characteristic')->withPivot('value');
    }
    public function proficiencies()
    {
        return $this->hasMany(Proficiency::class, 'characteristic_id');
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(20),
        ];
    }
}
