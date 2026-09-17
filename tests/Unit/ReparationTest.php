<?php

namespace Tests\Unit;

use App\Models\Reparation;
use PHPUnit\Framework\TestCase;

class ReparationTest extends TestCase
{
    public function test_une_reparation_peut_etre_creee(): void
    {
        $reparation = new Reparation([
            'vehicule_id' => 1,
            'date' => '2026-09-09',
            'duree_main_oeuvre' => 3,
            'objet_reparation' => 'Vidange et changement des filtres',
        ]);

        $this->assertEquals(1, $reparation->vehicule_id);
        $this->assertEquals('2026-09-09', $reparation->date);
        $this->assertEquals(3, $reparation->duree_main_oeuvre);
        $this->assertEquals(
            'Vidange et changement des filtres',
            $reparation->objet_reparation
        );
    }
}