<?php

namespace App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class Race extends Model implements HasMedia, Searchable
{
    use InteractsWithMedia;
    protected $fillable = ['name', 'description', 'move_speed', 'suggested_names', 'available_proficiency'];

    public function characters() {
        return $this->hasMany(Character::class);
    }

    public function abilities() {
        return $this->belongsToMany(Ability::class, 'race_ability');
    }

    public function languages() {
        return $this->belongsToMany(Language::class, 'race_language');
    }

    public function characteristics() {
        return $this->belongsToMany(Characteristic::class, 'race_characteristic')->withPivot('value');
    }

    public function proficiencies() {
        return $this->belongsToMany(Proficiency::class, 'race_proficiency');
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(30),
            Textarea::make('description')
                ->required()
                ->columnSpanFull(),
            TextInput::make('suggested_names')
                ->maxLength(200),
            TextInput::make('move_speed')
                ->required()
                ->numeric(),
        ];
    }
    public function registerMediaCollections(): void {
        $this->addMediaCollection('image')->singleFile();
    }

    public function getSearchResult(): SearchResult
    {
        $url = '/race/' . $this->id;

        return new SearchResult(
            $this,
            $this->name,
            $url,
        );
    }
}
