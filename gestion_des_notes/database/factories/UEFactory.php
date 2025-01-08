<?php

namespace Database\Factories;

use App\Models\UE;
use Illuminate\Database\Eloquent\Factories\Factory;

class UEFactory extends Factory
{
    /**
     * Le modèle correspondant à cette factory.
     */
    protected $model = UE::class;

    /**
     * Définir l'état par défaut du modèle.
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->regexify('UE[0-9]{2}'),
            'nom' => $this->faker->word(),
            'credits' => $this->faker->numberBetween(1, 30),
            'semestre' => $this->faker->numberBetween(1, 6),
        ];
    }
}
