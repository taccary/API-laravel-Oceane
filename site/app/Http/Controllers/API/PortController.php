<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;

class PortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lesPorts = Port::all();
        return response()-> json($lesPorts,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $nom_court)
    {
        $lePort = Port::findOrFail($nom_court);
        return response()->json($lePort, 200);
    }

    /**
     * Store a newly created resource in storage.
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
     * Update the specified resource in storage.
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
        $port -> nom = $request -> input('nom');
        $port -> description = $request -> input('description');
        $port -> adresse = $request -> input('adresse');

        if($request->filled('photo')) {
            $port -> image = $request -> input('photo'); 
        }

        if ($request->filled('camera')) {
            $port->camera = $request->input('camera');
        }

        $port -> save();
        return response() -> json($port, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nom_court)
    {
        $lePort = Port::findOrFail($nom_court);
        $lePort -> delete();
        return response() -> json($nom_court + " à bien été supprimer ", 204);

    }
}
