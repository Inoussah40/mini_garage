<?php

namespace Database\Factories;

use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reparation>
 */
class ReparationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'vehicule_id' => Vehicule::factory(),
            'date' => fake()->date(),
            'duree_main_oeuvre' => fake()->numberBetween(1, 12),
            'objet_reparation' => fake()->randomElement([
                'Vidange et entretien général',
                'Réparation du système de freinage',
                'Remplacement de la batterie',
                'Réparation du moteur',
                'Changement des pneus',
                'Réparation de la climatisation',
                'Réparation électrique',
            ]),
        ];
    }
}