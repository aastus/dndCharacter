<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model {
    protected $fillable = ['name', 'description', 'level'];

    public function classes() {
        return $this->belongsToMany(ClassModel::class, 'class_ability', 'ability_id', 'class_id');
    }

    public function races() {
        return $this->belongsToMany(Race::class, 'race_ability');
    }

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_ability');
    }
}
