<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

//use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function index() {
        $skills = Skill::all();
        return response()->json($skills, 200);
    }

    public function show($id) {
        $skill = Skill::findOrFail($id);
        return response()->json($skill, 200);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',

        ]);

        $skill = Skill::create($request->all());

        return response()->json($skill, 201);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:255',

        ]);

        $skill = Skill::findOrFail($id);
        $skill->update($request->all());

        return response()->json($skill, 200);
    }

    public function destroy($id) {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return response()->json(['message' => 'Skill deleted'], 200);
    }
}
