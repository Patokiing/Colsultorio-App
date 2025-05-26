<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\Especialidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    protected $model = Cita::class;

    public function definition()
    {
        return [
            'fech' => $this->faker->date(),
            'id_espe' => Especialidad::factory(), // Esto crea una especialidad nueva para cada cita
            
        ];
    }
}
