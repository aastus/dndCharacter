<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller {
    public function characterShort($id) {
        $rec = [];
        $character = Character::find($id);

        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }

        $rec['id'] = $id;
        $rec['player'] = $character->character_name;
        $rec['name'] = $character->name;

        $rec['level'] = $character->level;
        $rec['hp'] = $character->hit_points;
        $rec['max_hp'] = $rec['level'] * ($character->class ? $character->class->hp_per_level : 0)
            + floor(($character->characteristics[2]->pivot->value - 10) / 2);
        $rec['at'] = $character->armor_type;
        $rec['speed'] = $character->race ? $character->race->move_speed : 0;
        $rec['plus_speed'] = $character->plus_speed;

        $rec['class'] = $character->class ? $character->class->name : null;
        $rec['race'] = $character->race ? $character->race->name : null;

        $rec['inventory'] = $character->inventory;
        $rec['notes'] = $character->notes;

        return response()->json($rec);
    }

    public function characterEdit($id, Request $request) {
        try {
            $character = Character::find($id);

            if (!$character) {
                return response()->json(['error' => 'Character not found'], 404);
            }

            $validator = Validator::make($request->all(), [
                'hp' => 'nullable|integer|min:0',
                'at' => 'nullable|integer',
                'level' => 'nullable|integer|min:1',
                'speed' => 'nullable|integer|min:0',
                'inventory' => 'nullable|string',
                'notes' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => 'Validation failed', 'details' => $validator->errors()], 422);
            }

            if ($request->has('hp')) $character->hit_points = $request->input('hp');
            if ($request->has('at')) $character->armor_type = $request->input('at');
            if ($request->has('level')) $character->level = $request->input('level');
            if ($request->has('speed')) $character->plus_speed = $request->input('speed');
            if ($request->has('inventory')) $character->inventory = $request->input('inventory');
            if ($request->has('notes')) $character->notes = $request->input('notes');

            $character->save();

            return response()->json(['message' => 'Character updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error in characterEdit: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred', 'details' => $e->getMessage()], 500);
        }
    }

    public function characterList($id) {
        $character = Character::find($id);
        return response()->json($character);
    }
}