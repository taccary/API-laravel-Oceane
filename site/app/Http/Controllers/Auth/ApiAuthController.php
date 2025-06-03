<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller


{ 
public function login(Request $request) 
 { 
$credentials = $request->only('email', 'password'); 
 if (!$token = auth('api')->attempt($credentials)) { 
 return response()->json(['error' => 'Unauthorized'], 401); 
 } 
return response()->json(['token' => $token]); 
} 

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

 public function me() 
 { 
return response()->json(auth('api')->user()); 
 } 

 

 public function logout() 

 { 

auth('api')->logout(); 
 return response()->json(['message' => 'Successfully logged out']); 

} 
}

