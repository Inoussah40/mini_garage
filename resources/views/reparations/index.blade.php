@extends('layouts.app')

@section('title', 'Gestion des réparations')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">Gestion des réparations</h1>
            <p class="text-muted mb-0">
                Liste des réparations effectuées dans le garage
            </p>
        </div>

        <a href="{{ route('reparations.blade.create') }}"
           class="btn btn-primary">
            + Nouvelle réparation
        </a>
    </div>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Nombre de réparations --}}
    <div class="mb-3">
        <span class="badge bg-dark fs-6">
            {{ $reparations->count() }} réparations
        </span>
    </div>

    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Liste des réparations</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover table-bordered align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Véhicule</th>
                            <th>Date</th>
                            <th>Durée</th>
                            <th>Objet de la réparation</th>
                            <th>Techniciens</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($reparations as $reparation)

                            <tr>

                                {{-- ID --}}
                                <td>
                                    {{ $reparation->id }}
                                </td>

                                {{-- Véhicule --}}
                                <td>
                                    @if ($reparation->vehicule)

                                        <strong>
                                            {{ $reparation->vehicule->marque }}
                                            {{ $reparation->vehicule->modele }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            {{ $reparation->vehicule->immatriculation }}
                                        </small>

                                    @else

                                        <span class="text-muted">
                                            Véhicule supprimé
                                        </span>

                                    @endif
                                </td>

                                {{-- Date --}}
                                <td>
                                    {{ $reparation->date }}
                                </td>

                                {{-- Durée --}}
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $reparation->duree_main_oeuvre }} h
                                    </span>
                                </td>

                                {{-- Objet --}}
                                <td>
                                    {{ $reparation->objet_reparation }}
                                </td>

                                {{-- Techniciens --}}
                                <td>
                                    @forelse ($reparation->techniciens as $technicien)

                                       <span class="badge bg-secondary me-1 mb-1">
                                               👨‍🔧
                                           {{ $technicien->prenom }}
                                           {{ $technicien->nom }}
                                       </span>

                                           @empty

                                         <span class="text-muted">
                                              Aucun technicien
                                         </span>

                                    @endforelse

                                </td>

                                {{-- Actions --}}
                                <td>
                                    <a
                                        href="{{ route('reparations.blade.show', $reparation) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        👁️ Voir détails
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7"
                                    class="text-center text-muted py-4">
                                    Aucune réparation enregistrée.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection