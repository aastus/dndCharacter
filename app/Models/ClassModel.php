<?php

namespace App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model {
    protected $table = 'classes';
    protected $fillable = ['name', 'description', 'hp_per_level', 'is_magic', 'available_proficiency'];

    public function characters() {
        return $this->hasMany(Character::class);
    }

    public function savingthrows() {
        return $this->belongsToMany(Characteristic::class, 'class_characteristic', 'class_id');
    }

    public function abilities() {
        return $this->belongsToMany(Ability::class, 'class_ability', 'class_id');
    }

    public function spells() {
        return $this->belongsToMany(Spell::class, 'class_spell', 'class_id');
    }

    public function proficiencies() {
        return $this->belongsToMany(Proficiency::class, 'class_proficiency', 'class_id');
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(20),
            Textarea::make('description')
                ->required()
                ->columnSpanFull(),
            TextInput::make('hp_per_level')
                ->required()
                ->numeric(),
            Toggle::make('is_magic')
                ->required(),
        ];
    }
}
