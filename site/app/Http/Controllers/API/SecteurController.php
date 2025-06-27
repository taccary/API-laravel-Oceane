<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Secteur;
use Illuminate\Http\Request;

class SecteurController extends Controller
{
    // Liste tous les secteurs
    public function index()
    {
        return response()->json(Secteur::all());
    }

    // Affiche un secteur spécifique
    public function show($id)
    {
        $secteur = Secteur::findOrFail($id);
        return response()->json($secteur);
    }

    // Crée un nouveau secteur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'photo' => 'nullable|string',
            'description' => 'nullable|string',
            'url' => 'nullable|string',
        ]);
        $secteur = Secteur::create($validated);
        return response()->json($secteur, 201);
    }

    // Met à jour un secteur
    public function update(Request $request, $id)
    {
        $secteur = Secteur::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'photo' => 'nullable|string',
            'description' => 'nullable|string',
            'url' => 'nullable|string',
        ]);
        $secteur->update($validated);
        return response()->json($secteur);
    }

    // Supprime un secteur
    public function destroy($id)
    {
        $secteur = Secteur::findOrFail($id);
        $secteur->delete();
        return response()->json(null, 204);
    }
}
