<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

//        if (Auth::attempt($credentials)){
//            $request->session()->regenerate();
//            return response()->json([
//                'message' => 'Success login'
//                ]);
//        }

        $auth = User::where('email', $request->email)->first();
        if (!empty($auth)){
            if (password_verify($request->password, $auth->password)){
                $token = $auth->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'message' => 'Success login',
                    'token' => $token,
                    'user' => $auth
                ]);
            }
            return response()->json(['message' => 'Failed login, email or password incorrect']);
        }

        return response()->json(['message' => 'Failed login'], 401);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Sukses logout'
        ]);
    }
}
