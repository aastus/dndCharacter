<?php

namespace App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Alignment extends Model implements Searchable {
    protected $fillable = ['name', 'description'];

    public $timestamps = false;

    public function characters() {
        return $this->hasMany(Character::class);
    }

    public static function getForm()
    {
        return [
           TextInput::make('name')
                ->required()
                ->maxLength(25),
           Textarea::make('description')
                ->required()
                ->columnSpanFull(),
        ];
    }

    public function getSearchResult(): SearchResult
    {
        $url = '/alignments#heading' . ($this->id - 1);

        return new SearchResult(
            $this,
            $this->name,
            $url,
        );
    }
}
