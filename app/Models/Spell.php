<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spell extends Model {
    protected $fillable = ['name', 'description', 'level'];

    public function classes() {
        return $this->belongsToMany(ClassModel::class, 'class_spell');
    }

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_spell');
    }
}
