<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicule>
 */
class VehiculeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'immatriculation' => fake()->unique()->bothify('??-###-??'),
            'marque' => fake()->randomElement([
                'Toyota',
                'Peugeot',
                'Renault',
                'Mercedes',
                'Hyundai',
                'Volkswagen',
                'Ford',
            ]),
            'modele' => fake()->randomElement([
                'Corolla',
                'Clio',
                'Civic',
                'Golf',
                'Focus',
                'i10',
                '308',
            ]),
            'couleur' => fake()->randomElement([
                'Noir',
                'Blanc',
                'Gris',
                'Rouge',
                'Bleu',
            ]),
            'annee' => fake()->numberBetween(2015, 2025),
            'kilometrage' => fake()->numberBetween(10000, 250000),
            'carrosserie' => fake()->randomElement([
                'Berline',
                'SUV',
                'Citadine',
                'Break',
                'Coupé',
            ]),
            'energie' => fake()->randomElement([
                'Essence',
                'Diesel',
                'Hybride',
                'Électrique',
            ]),
            'boite' => fake()->randomElement([
                'Manuelle',
                'Automatique',
            ]),
        ];
    }
}