<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'empresa_id',
        'prioridad',
        //'codigo',
        'descripcion',
        'unimed_ingreso_id',
        'unimed_cobro_id',
        'factor_conversion',
        'codigo_flexline',
        'vigente'
    ];
}
