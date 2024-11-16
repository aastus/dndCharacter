<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Weapon extends Model implements Searchable {
    protected $fillable = ['name', 'description', 'cost', 'damage', 'characteristic_id'];

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_weapon');
    }

    public function characteristic() {
        return $this->belongsTo(Characteristic::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = '/weapons';

        return new SearchResult(
            $this,
            $this->name,
            $url,
        );
    }
}
