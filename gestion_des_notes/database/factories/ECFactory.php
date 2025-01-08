<?php

namespace Database\Factories;

use App\Models\EC;
use App\Models\UE;
use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ECFactory extends Factory
{
    /**
     * Le modèle correspondant à cette factory.
     */
    protected $model = EC::class;

    /**
     * Définir l'état par défaut du modèle.
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->regexify('EC[0-9]{3}'),
            'nom' => $this->faker->word(),
            'coefficient' => $this->faker->numberBetween(1, 5),
            'ue_id' => UE::factory(), // Crée une UE si aucune n'existe
            'responsable_id' => Enseignant::factory(), // Crée un Enseignant si aucune association n'est fournie
        ];
    }
}
