<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BateauxController;
use App\Http\Controllers\API\PortController;
use App\Http\Controllers\Auth\ApiAuthController;
use Firebase\JWT\JWT; 
use Firebase\JWT\Key; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/bateaux', [BateauxController::class, 'index']);
Route::get('/bateaux/{idBateau}', [BateauxController::class, 'show']);

Route::middleware('auth:api')->post('/bateaux', [BateauxController::class, 'store']);
Route::middleware('auth:api')->put('/bateaux/{idBateau}', [BateauxController::class, 'update']);
Route::middleware('auth:api')->delete('/bateaux/{idBateau}', [BateauxController::class, 'destroy']);



Route::get('/ports', [PortController::class, 'index']);
Route::get('/ports/{nom_court}', [PortController::class, 'show']);

Route::post('/ports', [PortController::class, 'store']);
Route::put('/ports/{nom_court}', [PortController::class, 'update']);
Route::delete('/ports/{nom_court}', [PortController::class, 'destroy']);


Route::put('/test-put', function () {
    return response()->json(['message' => 'PUT OK']);
});

Route::post('/login', [ApiAuthController::class, 'login']); 
Route::middleware('auth:api')->get('/me', [ApiAuthController::class, 'me']); 
Route::middleware('auth:api')->post('/logout', [ApiAuthController::class, 'logout']); 


Route::get('/debug-jwt', function (Request $request) { 

    $token = $request->bearerToken(); // on récupère le token 

    if (!$token) { 

        return response()->json(['error' => 'Aucun token fourni'], 400); 

    } 

    $parts = explode('.', $token); 

    if (count($parts) !== 3) { 

        return response()->json(['error' => 'Token invalide'], 400); 

    } 

    $header = json_decode(base64_decode($parts[0]), true); 

    $payload = json_decode(base64_decode($parts[1]), true); 

    return response()->json([ 

        'header' => $header, 

        'payload' => $payload, 

    ]); 

}); 

Route::get('/verify-jwt', function (Request $request) { 

    $token = $request->bearerToken(); 

    if (!$token) { 

        return response()->json(['error' => 'Aucun token fourni'], 400); 

    } 

    try { 

        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256')); 

        return response()->json(['valid' => true, 'payload' => (array)$decoded]); 

    } catch (\Exception $e) { 

        return response()->json(['valid' => false, 'error' => $e->getMessage()], 401); 

    } 

}); 