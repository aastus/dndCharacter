<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proficiency extends Model {
    protected $fillable = ['name', 'characteristic_id'];

    public $timestamps = false;

    public function backgrounds() {
        return $this->belongsToMany(Background::class, 'background_proficiency');
    }

    public function races() {
        return $this->belongsToMany(Race::class, 'race_proficiency');
    }

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_proficiency');
    }

    public function characteristic() {
        return $this->belongsTo(Characteristic::class, 'characteristic_id');
    }

}
