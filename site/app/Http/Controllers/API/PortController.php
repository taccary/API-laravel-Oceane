<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;

class PortController extends Controller
{
    /**
     * Renvoie la liste de tous les ports.
     */
    public function index()
    {
        $lesPorts = Port::all();
        return response()-> json($lesPorts,200);
    }

    /**
     * Renvoie les détails d'un port spécifique.
     */
    public function show(String $nom_court)
    {
        $lePort = Port::findOrFail($nom_court);
        return response()->json($lePort, 200);
    }

    /**
     * Enregistre un nouveau port.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nom_court' => 'required|string|max:50',
            'nom' => 'required|string|max:100',
            'description' => 'required|string|max: 500',
            'adresse'  => 'required|string|max : 150',
            'photo' => 'nullable|string',
            'camera' => 'nullable|string' 
        ]);

        $port = new Port();
        $port -> nom_court = $request -> input('nom_court');
        $port -> nom = $request -> input('nom');
        $port -> description = $request -> input('description');
        $port -> adresse = $request -> input('adresse');

        if($request->filled('photo')) {
            $port -> photo = $request -> input('photo'); 
        }

        if ($request->filled('camera')) {
            $port->camera = $request->input('camera');
        }

        $port -> save();
        return response() -> json($port, 201);
    }


    /**
     * Met à jour les informations d'un port spécifique.
     */
    public function update(Request $request, string $nom_court)
    {
        $request -> validate([
            'nom' => 'required|string|max:100',
            'description' => 'required|string|max: 500',
            'adresse'  => 'required|string|max : 150',
            'photo' => 'nullable|string',
            'camera' => 'nullable|string' 
        ]);

        $port = Port::find($nom_court);
        $port->nom = $request -> input('nom');
        $port->description = $request -> input('description');
        $port->adresse = $request -> input('adresse');

        if($request->filled('photo')) {
            $port->photo = $request -> input('photo'); 
        }

        if ($request->filled('camera')) {
            $port->camera = $request->input('camera');
        }

        $port->save();
        return response() -> json($port, 200);
    }

    /**
     * Supprime un port spécifique.
     */
    public function destroy(string $nom_court)
    {
        $lePort = Port::findOrFail($nom_court);
        $lePort -> delete();
        return response() -> json($nom_court + " à bien été supprimer ", 204);
    }
}
