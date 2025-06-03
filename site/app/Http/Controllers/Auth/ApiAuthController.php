<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller


{
    /** 
     * Retourne un token JWT si les identifiants sont valides
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(['token' => $token]);
    }

    /**
     * Enregistre un nouvel utilisateur et retourne un token JWT et les informations de l'utilisateur
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = auth('api')->login($user);
        return response()->json(['token' => $token, 'user' => $user], 201);
    }

    /**
     * Retourne les informations de l'utilisateur authentifié
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Déconnecte l'utilisateur et invalide le token JWT
     */
    public function logout()
    {

        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
