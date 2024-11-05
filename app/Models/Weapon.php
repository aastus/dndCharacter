<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weapon extends Model {
    protected $fillable = ['name', 'description', 'cost', 'damage', 'characteristic_id'];

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_weapon');
    }

    public function characteristic() {
        return $this->belongsTo(Characteristic::class);
    }
}
