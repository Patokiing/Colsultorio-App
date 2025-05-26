<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    protected $model = Paciente::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName,
            'ApPat' => $this->faker->lastName,
            'ApMat' => $this->faker->lastName,
            // Agrega otros campos según sea necesario
        ];
    }
}
