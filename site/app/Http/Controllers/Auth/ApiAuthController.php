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

