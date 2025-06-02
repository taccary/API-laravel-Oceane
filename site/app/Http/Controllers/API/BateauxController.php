<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bateau;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;

class BateauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $lesBateaux = Bateau::all(); 
        return response()->json($lesBateaux, 200); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : \Illuminate\Http\JsonResponse
    {
        $request->validate([ 
            'id' => 'required|integer', 
            'nom' => 'required|string|max:255', 
            'description' => 'required|string|max:1000', 
        ]); 

        $bateau = new Bateau(); 
        $bateau->id = $request->input('id'); 
        $bateau->nom = $request->input('nom'); 
        $bateau->description = $request->input('description'); 
        $bateau->save(); 
        return response()->json($bateau, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(int  $idBateau)
    {
         $bateau = Bateau::findOrFail($idBateau); 
        return response()->json($bateau, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int  $idBateau) : \Illuminate\Http\JsonResponse
    {
        $request->validate([ 
            'nom' => 'required|string|max:255', 
            'description' => 'required|string|max:1000', 
        ]); 

 
        $bateau = Bateau::find($idBateau); 
        $bateau->nom = $request->input('nom'); 
        $bateau->description = $request->input('description'); 
        $bateau->save(); 
        return response()->json($bateau, 200); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int  $idBateau)
    {
        $bateau = Bateau::findOrFail($idBateau); 
        $bateau->delete(); 
        return response()->json(null, 204); 
    }
}

