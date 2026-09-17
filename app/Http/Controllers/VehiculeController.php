<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    // API : liste des véhicules
    public function index()
    {
        return response()->json(Vehicule::all());
    }

    // Blade : affichage de la liste des véhicules avec recherche
    public function bladeIndex(Request $request)
    {
        $recherche = $request->input('recherche');

        $vehicules = Vehicule::query()
            ->when($recherche, function ($query, $recherche) {
                $query->where('marque', 'like', '%' . $recherche . '%')
                      ->orWhere('immatriculation', 'like', '%' . $recherche . '%');
            })
            ->get();

        return view('vehicules.index', compact('vehicules', 'recherche'));
    }

    // API : création d'un véhicule
    public function store(Request $request)
    {
        $vehicule = Vehicule::create($request->validate([
            'immatriculation' => 'required|string|unique:vehicules,immatriculation',
            'marque' => 'required|string',
            'modele' => 'required|string',
            'couleur' => 'required|string',
            'annee' => 'required|integer',
            'kilometrage' => 'required|integer',
            'carrosserie' => 'required|string',
            'energie' => 'required|string',
            'boite' => 'required|string',
        ]));

        return response()->json($vehicule, 201);
    }

    // API : afficher un véhicule
    public function show(Vehicule $vehicule)
    {
        return response()->json($vehicule);
    }

    // API : modifier un véhicule
    public function update(Request $request, Vehicule $vehicule)
    {
        $vehicule->update($request->validate([
            'immatriculation' => 'sometimes|string|unique:vehicules,immatriculation,' . $vehicule->id,
            'marque' => 'sometimes|string',
            'modele' => 'sometimes|string',
            'couleur' => 'sometimes|string',
            'annee' => 'sometimes|integer',
            'kilometrage' => 'sometimes|integer',
            'carrosserie' => 'sometimes|string',
            'energie' => 'sometimes|string',
            'boite' => 'sometimes|string',
        ]));

        return response()->json($vehicule);
    }

    // API : supprimer un véhicule
    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();

        return response()->json([
            'message' => 'Véhicule supprimé avec succès'
        ]);
    }
}