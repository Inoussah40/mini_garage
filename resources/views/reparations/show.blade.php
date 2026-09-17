@extends('layouts.app')

@section('title', 'Détail de la réparation')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold">Détail de la réparation</h1>
            <p class="text-muted mb-0">
                Informations détaillées sur la réparation
            </p>
        </div>

        <a href="{{ route('reparations.blade.index') }}"
           class="btn btn-secondary">
            ← Retour aux réparations
        </a>

    </div>

    {{-- Informations générales --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">
                Réparation #{{ $reparation->id }}
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Date :</strong>
                    <span class="ms-2">
                        {{ $reparation->date }}
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Durée de main-d'œuvre :</strong>
                    <span class="badge bg-info text-dark ms-2">
                        {{ $reparation->duree_main_oeuvre }} h
                    </span>
                </div>

                <div class="col-12">
                    <strong>Objet de la réparation :</strong>

                    <p class="mt-2 mb-0">
                        {{ $reparation->objet_reparation }}
                    </p>
                </div>

            </div>

        </div>

    </div>

    {{-- Véhicule --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">🚗 Véhicule concerné</h5>
        </div>

        <div class="card-body">

            @if ($reparation->vehicule)

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <strong>Marque :</strong>
                        <br>
                        {{ $reparation->vehicule->marque }}
                    </div>

                    <div class="col-md-4 mb-3">
                        <strong>Modèle :</strong>
                        <br>
                        {{ $reparation->vehicule->modele }}
                    </div>

                    <div class="col-md-4 mb-3">
                        <strong>Immatriculation :</strong>
                        <br>
                        <span class="badge bg-dark">
                            {{ $reparation->vehicule->immatriculation }}
                        </span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <strong>Couleur :</strong>
                        <br>
                        {{ $reparation->vehicule->couleur }}
                    </div>

                    <div class="col-md-4 mb-3">
                        <strong>Année :</strong>
                        <br>
                        {{ $reparation->vehicule->annee }}
                    </div>

                    <div class="col-md-4 mb-3">
                        <strong>Kilométrage :</strong>
                        <br>
                        {{ number_format($reparation->vehicule->kilometrage, 0, ',', ' ') }}
                        km
                    </div>

                </div>

            @else

                <p class="text-muted mb-0">
                    Le véhicule associé n'existe plus.
                </p>

            @endif

        </div>

    </div>

    {{-- Techniciens --}}
    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            <h5 class="mb-0">👨‍🔧 Techniciens affectés</h5>
        </div>

        <div class="card-body">

            @forelse ($reparation->techniciens as $technicien)

                <div class="d-flex align-items-center border-bottom py-3">

                    <div class="me-3">
                        <span class="badge bg-secondary">
                            #{{ $technicien->id }}
                        </span>
                    </div>

                    <div>
                        <strong>
                            {{ $technicien->prenom }}
                            {{ $technicien->nom }}
                        </strong>

                        <br>

                        <small class="text-muted">
                            {{ $technicien->specialite }}
                        </small>
                    </div>

                </div>

            @empty

                <p class="text-muted mb-0">
                    Aucun technicien affecté à cette réparation.
                </p>

            @endforelse

        </div>

    </div>

@endsection