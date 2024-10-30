<?php

namespace Database\Factories;

use App\Models\RdvPanneauxPhotovoltaique;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RdvPanneauxPhotovoltaique>
 */
class RdvPanneauxPhotovoltaiqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     protected $model = RdvPanneauxPhotovoltaique::class;
     public function definition(): array
     {
        return [
            'agent_id' => $this->faker->randomElement([2,3,4,5]),
            'partenaire_id' => $this->faker->randomElement([6,7,8,9]), 
            'nom_du_prospect' => $this->faker->name(),
            'prenom_du_prospect' => $this->faker->firstName(),
            'telephone' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->address(),
            'code_postal' => $this->faker->postcode(),
            'ville' => $this->faker->city(),
            'date_du_rdv' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'statut_de_residence' => $this->faker->randomElement(['locataire','propriétaire ']),
            'Commentaire_agent' => $this->faker->sentence(),
            'Commentaire_partenaire' => $this->faker->sentence(),
            'classification' => fake()->randomElement(['NRP','Hors cible','RDV confirmé','RDV installé','Pas intéressé','RDV annulé','RDV à rappeler',null]),
            'date_classification' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'date_rappelle' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'created_at'=> $this->faker->dateTimeBetween('-6 months', 'now') ,
        ];
    }
}