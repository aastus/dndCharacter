<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\ClassModel;
use App\Models\Race;
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

}
