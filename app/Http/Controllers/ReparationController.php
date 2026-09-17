<?php

namespace App\Http\Controllers;

use App\Models\Reparation;
use App\Models\Vehicule;
use App\Models\Technicien;
use Illuminate\Http\Request;

class ReparationController extends Controller
{
    // =========================================================
    // API : liste des réparations
    // =========================================================
    public function index()
    {
        $reparations = Reparation::with(['vehicule', 'techniciens'])->get();

        return response()->json($reparations);
    }

    // =========================================================
    // BLADE : liste des réparations
    // =========================================================
    public function bladeIndex()
    {
        $reparations = Reparation::with([
            'vehicule',
            'techniciens'
        ])->get();

        return view('reparations.index', compact('reparations'));
    }

    // =========================================================
    // BLADE : afficher le détail d'une réparation
    // Route Model Binding
    // =========================================================
    public function bladeShow(Reparation $reparation)
    {
        $reparation->load([
            'vehicule',
            'techniciens'
        ]);

        return view('reparations.show', compact('reparation'));
    }

    // =========================================================
    // BLADE : formulaire de création
    // =========================================================
    public function createBlade()
    {
        $vehicules = Vehicule::all();
        $techniciens = Technicien::all();

        return view('reparations.create', compact(
            'vehicules',
            'techniciens'
        ));
    }

    // =========================================================
    // BLADE : enregistrer une réparation
    // =========================================================
    public function storeBlade(Request $request)
    {
        $data = $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'date' => 'required|date',
            'duree_main_oeuvre' => 'required|integer|min:1',
            'objet_reparation' => 'required|string',
            'techniciens' => 'nullable|array',
            'techniciens.*' => 'exists:techniciens,id',
        ]);

        $techniciens = $data['techniciens'] ?? [];

        unset($data['techniciens']);

        $reparation = Reparation::create($data);

        $reparation->techniciens()->sync($techniciens);

        return redirect()
            ->route('reparations.blade.index')
            ->with('success', 'Réparation créée avec succès.');
    }

    // =========================================================
    // API : création d'une réparation
    // =========================================================
    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'date' => 'required|date',
            'duree_main_oeuvre' => 'required|integer|min:1',
            'objet_reparation' => 'required|string',
            'techniciens' => 'nullable|array',
            'techniciens.*' => 'exists:techniciens,id',
        ]);

        $techniciens = $data['techniciens'] ?? [];

        unset($data['techniciens']);

        $reparation = Reparation::create($data);

        $reparation->techniciens()->sync($techniciens);

        return response()->json(
            $reparation->load(['vehicule', 'techniciens']),
            201
        );
    }

    // =========================================================
    // API : afficher une réparation
    // =========================================================
    public function show(Reparation $reparation)
    {
        return response()->json(
            $reparation->load(['vehicule', 'techniciens'])
        );
    }

    // =========================================================
    // API : modifier une réparation
    // =========================================================
    public function update(Request $request, Reparation $reparation)
    {
        $data = $request->validate([
            'vehicule_id' => 'sometimes|exists:vehicules,id',
            'date' => 'sometimes|date',
            'duree_main_oeuvre' => 'sometimes|integer|min:1',
            'objet_reparation' => 'sometimes|string',
            'techniciens' => 'nullable|array',
            'techniciens.*' => 'exists:techniciens,id',
        ]);

        if (array_key_exists('techniciens', $data)) {

            $techniciens = $data['techniciens'] ?? [];

            unset($data['techniciens']);

            $reparation->techniciens()->sync($techniciens);
        }

        $reparation->update($data);

        return response()->json(
            $reparation->load(['vehicule', 'techniciens'])
        );
    }

    // =========================================================
    // API : supprimer une réparation
    // =========================================================
    public function destroy(Reparation $reparation)
    {
        $reparation->techniciens()->detach();

        $reparation->delete();

        return response()->json([
            'message' => 'Réparation supprimée avec succès'
        ]);
    }
}