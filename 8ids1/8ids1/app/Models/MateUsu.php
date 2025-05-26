<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateUsu extends Model
{
    use HasFactory;
    protected $table = 'materiales_usados';
    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
    public function medicamento()
    {
        return $this->belongsTo(Material::class, 'id_mate');
    }
}
