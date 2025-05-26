<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    // Define la tabla que utiliza el modelo
    protected $table = 'especialidades';
    
    // Agrega los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
    ];

    // Definir la relación con Medicamento
    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class);
    }
}
