<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';

    protected $fillable = ['descripcion', 'precio', 'fecha_caducidad', 'existencia', 'id_espe'];

    
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }
    
}
