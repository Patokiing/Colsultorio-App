<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtencionCita extends Model
{
    protected $fillable = ['cita_id', 'observaciones_doctor'];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'cita_id');
    }

    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'medicamentos_atendidos', 'cita_id', 'medicamento_id')
                    ->withPivot('cantidad', 'frecuencia'); // Incluye el campo frecuencia en la relación pivote
    }
}
