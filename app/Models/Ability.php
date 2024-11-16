<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class Ability extends Model implements Searchable {
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

    public function getSearchResult(): SearchResult
    {
        $url = '/ability/' . $this->id;

        return new SearchResult(
            $this,
            $this->name,
            $url,
        );
    }
}
