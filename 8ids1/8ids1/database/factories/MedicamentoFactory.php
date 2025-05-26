<?php

namespace Database\Factories;

use App\Models\Medicamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicamentoFactory extends Factory
{
    protected $model = Medicamento::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->numerify('###'),
            'descripcion' => $this->faker->word(),
            'precio' => $this->faker->randomFloat(2, 1, 100),
            'fecha_caducidad' => $this->faker->date(),
            'existencia' => $this->faker->numberBetween(1, 100),
        ];
    }
}
