<?php

namespace App\Http\Controllers;

use App\Models\Technicien;
use Illuminate\Http\Request;

class TechnicienController extends Controller
{
    public function index()
    {
        return response()->json(
            Technicien::with('reparations')->get()
        );
    }

    public function store(Request $request)
    {
        $technicien = Technicien::create($request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'specialite' => 'required|string',
        ]));

        return response()->json($technicien, 201);
    }

    public function show(Technicien $technicien)
    {
        return response()->json(
            $technicien->load('reparations')
        );
    }

    public function update(Request $request, Technicien $technicien)
    {
        $technicien->update($request->validate([
            'nom' => 'sometimes|string',
            'prenom' => 'sometimes|string',
            'specialite' => 'sometimes|string',
        ]));

        return response()->json($technicien);
    }

    public function destroy(Technicien $technicien)
    {
        $technicien->delete();

        return response()->json([
            'message' => 'Technicien supprimé avec succès'
        ]);
    }
}