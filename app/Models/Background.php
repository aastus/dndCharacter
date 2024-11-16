<?php

namespace App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Background extends Model implements Searchable {
    protected $fillable = ['name', 'description'];

    public function characters() {
        return $this->hasMany(Character::class);
    }

    public function proficiencies() {
        return $this->belongsToMany(Proficiency::class, 'background_proficiency');
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
        $url = '/backgrounds#heading' . ($this->id - 1);

        return new SearchResult(
            $this,
            $this->name,
            $url,
        );
    }
}
