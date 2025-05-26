<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctores';

    // Define qué campos pueden ser asignados masivamente
    protected $fillable = [
        'name', // o el nombre de tu campo de nombre
        'telefono',
        'email',
        'password',
        'idusr',
        'id_especialidad',
        // Agrega otros campos según sea necesario
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idusr');
    }
   
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad');
    }
}
