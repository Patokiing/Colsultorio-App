<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no es la pluralización predeterminada
    protected $table = 'pacientes';

    // Define los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'ApPat',
        'ApMat',
        'tele',
        'idusr'
    ];

    // Relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idusr');
    }

    // Relación con el modelo Cita
     // Relación con el modelo Cita
     public function citas()
     {
         return $this->hasMany(Cita::class, 'id_paciente');
     }
  
}
