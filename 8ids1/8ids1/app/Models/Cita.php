<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    // Agregar 'hora' al array $fillable
    protected $fillable = [
        'fech', 'hora', 'estado', 'id_espe', 'id_doc', 'id_paciente', 'id_consul', 'obser'
    ];

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    // Relación con el modelo Consultorio
    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class, 'id_consul');
    }

    // Relación con el modelo Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_doc');
    }

    // Relación con el modelo Especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_espe');
    }

    // Relación muchos a muchos con el modelo Medicamento
    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'medicamentos_atendidos', 'cita_id', 'medicamento_id')
                    ->withPivot('cantidad', 'frecuencia');
    }
}