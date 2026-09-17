@extends('layouts.app')

@section('title', 'Nouvelle réparation')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">Nouvelle réparation</h1>
            <p class="text-muted mb-0">
                Enregistrer une nouvelle réparation dans le garage
            </p>
        </div>

        <a href="{{ route('reparations.blade.index') }}"
           class="btn btn-secondary">
            ← Retour
        </a>
    </div>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Veuillez corriger les erreurs suivantes :</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Informations de la réparation</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('reparations.blade.store') }}"
                  method="POST">

                @csrf

                {{-- Véhicule --}}
                <div class="mb-3">
                    <label for="vehicule_id" class="form-label fw-bold">
                        Véhicule
                    </label>

                    <select
                        name="vehicule_id"
                        id="vehicule_id"
                        class="form-select"
                        required
                    >
                        <option value="">
                            -- Sélectionner un véhicule --
                        </option>

                        @foreach ($vehicules as $vehicule)

                            <option
                                value="{{ $vehicule->id }}"
                                {{ old('vehicule_id') == $vehicule->id ? 'selected' : '' }}
                            >
                                {{ $vehicule->marque }}
                                {{ $vehicule->modele }}
                                - {{ $vehicule->immatriculation }}
                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- Date --}}
                <div class="mb-3">
                    <label for="date" class="form-label fw-bold">
                        Date de la réparation
                    </label>

                    <input
                        type="date"
                        name="date"
                        id="date"
                        class="form-control"
                        value="{{ old('date', date('Y-m-d')) }}"
                        required
                    >
                </div>

                {{-- Durée --}}
                <div class="mb-3">
                    <label for="duree_main_oeuvre" class="form-label fw-bold">
                        Durée de main-d'œuvre (heures)
                    </label>

                    <input
                        type="number"
                        name="duree_main_oeuvre"
                        id="duree_main_oeuvre"
                        class="form-control"
                        min="1"
                        value="{{ old('duree_main_oeuvre') }}"
                        placeholder="Exemple : 5"
                        required
                    >
                </div>

                {{-- Objet de la réparation --}}
                <div class="mb-3">
                    <label for="objet_reparation" class="form-label fw-bold">
                        Objet de la réparation
                    </label>

                    <textarea
                        name="objet_reparation"
                        id="objet_reparation"
                        class="form-control"
                        rows="3"
                        placeholder="Décrire la réparation effectuée..."
                        required
                    >{{ old('objet_reparation') }}</textarea>
                </div>

                {{-- Techniciens --}}
                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Techniciens affectés
                    </label>

                    <div class="card bg-light">
                        <div class="card-body">

                            @forelse ($techniciens as $technicien)

                                <div class="form-check mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="techniciens[]"
                                        value="{{ $technicien->id }}"
                                        id="technicien{{ $technicien->id }}"
                                        {{ in_array(
                                            $technicien->id,
                                            old('techniciens', [])
                                        ) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="technicien{{ $technicien->id }}"
                                    >
                                        <strong>
                                            {{ $technicien->prenom }}
                                            {{ $technicien->nom }}
                                        </strong>

                                        <span class="text-muted">
                                            — {{ $technicien->specialite }}
                                        </span>
                                    </label>

                                </div>

                            @empty

                                <p class="text-muted mb-0">
                                    Aucun technicien disponible.
                                </p>

                            @endforelse

                        </div>
                    </div>

                    <small class="text-muted">
                        Vous pouvez sélectionner plusieurs techniciens.
                    </small>

                </div>

                {{-- Boutons --}}
                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        💾 Enregistrer la réparation
                    </button>

                    <a href="{{ route('reparations.blade.index') }}"
                       class="btn btn-secondary">
                        Annuler
                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection