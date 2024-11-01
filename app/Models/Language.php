<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {
    protected $fillable = ['name'];

    public $timestamps = false;

    public function races() {
        return $this->belongsToMany(Race::class, 'race_language');
    }

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_language');
    }
}
