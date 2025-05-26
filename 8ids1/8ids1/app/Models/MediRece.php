<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediRece extends Model
{
    use HasFactory;
    protected $table = 'materiales_recetado';
    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cit');
    }
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'id_medi');
    }
}
