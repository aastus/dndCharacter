<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model {
    protected $fillable = ['name'];

    public $timestamps = false;

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_characteristic')->withPivot('value');
    }
}
