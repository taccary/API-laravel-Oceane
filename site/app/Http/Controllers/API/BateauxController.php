<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bateau;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;

class BateauxController extends Controller
{
    /**
     * Renvoie la liste de tous les bateaux.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $lesBateaux = Bateau::all();
        return response()->json($lesBateaux, 200);
    }

    /**
     * Enregistre un nouveau bateau.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
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
     * Renvoie les détails d'un bateau spécifique.
     */
    public function show(int  $idBateau)
    {
        $bateau = Bateau::findOrFail($idBateau);
        return response()->json($bateau, 200);
    }

    /**
     * Met à jour les informations d'un bateau spécifique.
     */
    public function update(Request $request, int  $idBateau): \Illuminate\Http\JsonResponse
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
     * Supprime un bateau spécifique.
     */
    public function destroy(int  $idBateau)
    {
        $bateau = Bateau::findOrFail($idBateau);
        $bateau->delete();
        return response()->json(null, 204);
    }
}
