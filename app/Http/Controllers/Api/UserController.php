<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        // Retrieve and return a list of users
        $users = User::all();
        return response()->json($users, 200);
    }

    public function show($id) {
        // Retrieve and return a specific user by ID
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    public function store(Request $request) {
        // Validate and create a new user
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ]);

        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function update(Request $request, $id) {
        // Validate and update a specific user by ID
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'min:6',
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function destroy($id) {
        // Delete a specific user by ID
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted'], 200);
    }
}
