<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorizar extends Model
{
    use HasFactory;

    protected $table = 'autorizar';

    protected $fillable = [
        'id_cita',
        'fecha',
        'id_espe',
        'id_doc'
    ];
}
