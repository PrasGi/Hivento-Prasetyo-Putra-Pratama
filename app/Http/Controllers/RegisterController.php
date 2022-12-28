<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request){
        $validateData = $request->validate([
            'role_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|unique:users|email',
            'password' => 'required'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        if (User::create($validateData)) return response()->json(['message' => 'Success register account']);

        return response()->json(['message' => 'Failed register account']);
    }
}
