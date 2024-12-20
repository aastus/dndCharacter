<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model {
    protected $fillable = [
        'name', 'character_name','user_id',
        'class_id', 'race_id', 'background_id', 'alignment_id',
        'level', 'armor_type', 'hit_points', 'plus_speed',
        'traits', 'ideals', 'bonds', 'flaws',
        'prehistory', 'goals', 'notes', 'inventory',
        'age', 'height', 'weight',
        'eye_color', 'skin_color', 'hair_color'
    ];

    public function class() {
        return $this->belongsTo(ClassModel::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function race() {
        return $this->belongsTo(Race::class);
    }

    public function background() {
        return $this->belongsTo(Background::class);
    }

    public function alignment() {
        return $this->belongsTo(Alignment::class);
    }

    public function characteristics() {
        return $this->belongsToMany(Characteristic::class, 'character_characteristic')->withPivot('value');
    }

    public function languages() {
        return $this->belongsToMany(Language::class, 'character_language');
    }

    public function proficiencies() {
        return $this->belongsToMany(Proficiency::class, 'character_proficiency')->withPivot('specialize');
    }

    public function abilities() {
        return $this->belongsToMany(Ability::class, 'character_ability');
    }

    public function spells() {
        return $this->belongsToMany(Spell::class, 'character_spell');
    }

    public function weapons() {
        return $this->belongsToMany(Weapon::class, 'character_weapon');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('image')->singleFile();
    }
}
