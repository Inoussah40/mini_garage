<?php

namespace Tests\Unit;

use App\Models\Vehicule;
use PHPUnit\Framework\TestCase;

class VehiculeTest extends TestCase
{
    public function test_un_vehicule_peut_etre_cree(): void
    {
        $vehicule = new Vehicule([
            'immatriculation' => 'BF-123-AA',
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'couleur' => 'Blanc',
            'annee' => 2020,
            'kilometrage' => 50000,
            'carrosserie' => 'Berline',
            'energie' => 'Essence',
            'boite' => 'Manuelle',
        ]);

        $this->assertEquals('Toyota', $vehicule->marque);
        $this->assertEquals('Corolla', $vehicule->modele);
        $this->assertEquals('BF-123-AA', $vehicule->immatriculation);
    }
}