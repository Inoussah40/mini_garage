@extends('layouts.app')

@section('title', 'Gestion des véhicules')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">Gestion des véhicules</h1>
            <p class="text-muted mb-0">
                Liste des véhicules enregistrés dans le garage
            </p>
        </div>

        <span class="badge bg-primary fs-6">
            {{ $vehicules->count() }} véhicules
        </span>
    </div>

    {{-- Barre de recherche --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form action="{{ route('vehicules.index') }}" method="GET" class="row g-2">

                <div class="col-md-9">
                    <input
                        type="text"
                        name="recherche"
                        class="form-control"
                        placeholder="Rechercher par marque ou immatriculation..."
                        value="{{ $recherche ?? '' }}"
                    >
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">
                        🔍 Rechercher
                    </button>
                </div>

                <div class="col-md-1 d-grid">
                    <a href="{{ route('vehicules.index') }}" class="btn btn-secondary">
                        ↻
                    </a>
                </div>

            </form>

        </div>
    </div>

    {{-- Résultat de la recherche --}}
    @if (!empty($recherche))
        <div class="alert alert-info">
            Résultats pour la recherche :
            <strong>{{ $recherche }}</strong>
        </div>
    @endif

    {{-- Liste des véhicules --}}
    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Liste des véhicules</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover table-bordered align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Immatriculation</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Couleur</th>
                            <th>Année</th>
                            <th>Kilométrage</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($vehicules as $vehicule)

                            <tr>
                                <td>{{ $vehicule->id }}</td>

                                <td>
                                    <strong>
                                        {{ $vehicule->immatriculation }}
                                    </strong>
                                </td>

                                <td>{{ $vehicule->marque }}</td>

                                <td>{{ $vehicule->modele }}</td>

                                <td>{{ $vehicule->couleur }}</td>

                                <td>{{ $vehicule->annee }}</td>

                                <td>
                                    {{ number_format($vehicule->kilometrage, 0, ',', ' ') }}
                                    km
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Aucun véhicule trouvé.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection