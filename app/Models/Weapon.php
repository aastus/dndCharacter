<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weapon extends Model {
    protected $fillable = ['name', 'description', 'cost', 'damage'];

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_weapon');
    }
}
