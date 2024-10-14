<?php

namespace Database\Factories;

use App\Models\RdvThermostat;
use App\Models\User ;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RdvThermostat>
 */
class RdvThermostatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     protected $model = RdvThermostat::class;
     public function definition(): array
    {
        return [
            'agent_id' => User::factory(), 
            'partenaire_id' => User::factory(), 
            'nom_du_prospect' => $this->faker->name(),
            'prenom_du_prospect' => $this->faker->firstName(),
            'telephone' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->address(),
            'code_postal' => $this->faker->postcode(),
            'ville' => $this->faker->city(),
            'date_du_rdv' => $this->faker->date(),
            'statut_de_residence' => $this->faker->word(),
            'Commentaire_agent' => $this->faker->sentence(),
            'Commentaire_partenaire' => $this->faker->sentence(),
            'classification' => $this->faker->word(),
            'date_classification' => $this->faker->date(),
            'date_rappelle' => $this->faker->date(),
        ];
    }
}