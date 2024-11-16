<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Alignment;
use App\Models\Background;
use App\Models\ClassModel;
use App\Models\Race;
use App\Models\Spell;
use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Searchable\Search;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $races = Race::query()->orderBy('created_at', 'desc')->paginate(8);
        $classes = ClassModel::query()->orderBy('created_at', 'desc')->paginate(8);

        return view('pages.index', [
            'races' => $races,
            'classes' => $classes,
        ]);
    }

    public function search(Request $request) {
        $query = $request->input('query');
        if (!$query) {
            return response()->json(['error' => 'Search query is required'], 400);
        }

        $searchResults = (new Search())
            ->registerModel(Race::class, ['name'])
            ->registerModel(ClassModel::class, ['name'])
            ->registerModel(Spell::class, ['name'])
            ->registerModel(Ability::class, ['name'])
            ->registerModel(Weapon::class, ['name'])
            ->registerModel(Alignment::class, ['name'])
            ->registerModel(Background::class, ['name'])
            ->search($query);

        $mappedResults = $searchResults->map(function ($result) {
            return [
                'id' => $result->searchable->id,
                'title' => $result->title,
                'url' => $result->url,
                'type' => trans(Str::ucfirst($result->type)),
            ];
        });

        return response()->json($mappedResults);
    }
}
