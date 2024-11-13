<?php

namespace App\Http\Controllers;

use App\Models\Alignment;
use App\Models\Background;
use App\Models\Character;
use App\Models\ClassModel;
use App\Models\Race;
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
        $alignments = Alignment::orderBy('name', 'desc')->get();

        return view('info.alignment', [
            'alignments' => $alignments,
        ]);
    }
    public function backgrounds(Request $request)
    {
        $backgrounds = Background::with('proficiencies')->orderBy('name', 'desc')->get();

        return view('info.backgrounds', [
            'backgrounds' => $backgrounds,
        ]);
    }
    public function weapons(Request $request)
    {
        $weapons = Weapon::with('characteristic')->orderBy('name', 'desc')->get();

        return view('info.weapons', [
            'weapons' => $weapons,
        ]);
    }

}
