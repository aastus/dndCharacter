<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class Spell extends Model implements Searchable {
    protected $fillable = ['name', 'description', 'level'];

    public function classes() {
        return $this->belongsToMany(ClassModel::class, 'class_spell', 'spell_id', 'class_id');
    }

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_spell');
    }

    public function getSearchResult(): SearchResult
    {
        $url = '/spell/' . $this->id;

        return new SearchResult(
            $this,
            $this->name,
            $url,
        );
    }
}
