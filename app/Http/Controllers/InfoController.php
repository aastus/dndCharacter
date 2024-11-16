<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Alignment;
use App\Models\Background;
use App\Models\Character;
use App\Models\ClassModel;
use App\Models\Race;
use App\Models\Spell;
use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class InfoController extends Controller
{
    public function showRace($id)
    {
        $race = Race::with(['characteristics' => function ($query) {
            $query->withPivot('value');
        }])->findOrFail($id);

        return view('info.race', compact('race'));
    }
    public function showClass($id)
    {
        $class = ClassModel::with('abilities','spells','proficiencies')->findOrFail($id);

        return view('info.class', compact('class'));
    }
    public function alignments(Request $request)
    {
        $alignments = Alignment::orderBy('name', 'asc')->get();

        return view('info.alignment', [
            'alignments' => $alignments,
        ]);
    }
    public function classes(Request $request)
    {
        $classes = ClassModel::orderBy('name', 'asc')->get();

        return view('info.classes', [
            'classes' => $classes,
        ]);
    }
    public function races(Request $request)
    {
        $races = Race::orderBy('name', 'asc')->get();

        return view('info.races', [
            'races' => $races,
        ]);
    }
    public function backgrounds(Request $request)
    {
        $backgrounds = Background::with('proficiencies')->orderBy('name', 'asc')->get();

        return view('info.backgrounds', [
            'backgrounds' => $backgrounds,
        ]);
    }
    public function weapons(Request $request)
    {
        $weapons = Weapon::with('characteristic')->orderBy('name', 'asc')->get();

        return view('info.weapons', [
            'weapons' => $weapons,
        ]);
    }
    public function spells(Request $request)
    {
        $spells = Spell::with('classes')->orderBy('name', 'asc')->get();

        return view('info.spells', [
            'spells' => $spells,
        ]);
    }

    public function showSpell($id)
    {
        $spell = Spell::with('classes')->findOrFail($id);;

        return view('info.spell', [
            'spell' => $spell,
        ]);
    }
    public function abilities(Request $request)
    {
        $abilities = Ability::with('classes','races')->orderBy('name', 'asc')->get();

        return view('info.abilities', [
            'abilities' => $abilities,
        ]);
    }

    public function showAbility($id)
    {
        $ability = Ability::with('classes','races')->findOrFail($id);

        return view('info.ability', [
            'ability' => $ability,
        ]);
    }
}
