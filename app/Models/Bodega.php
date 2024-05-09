<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'codigo',
        'ubicacion',
        'ancho',
        'largo',
        'alto',
        'mt2',
        'mt2calc',
        'mt3calc',
        'ancho_porton',
        'alto_porton',
        'lateral_izq_porton',
        'lateral_der_porton',
        'tipoporton_id',
        'tipoconstruccion_id',
        'observacion',
        'equipamiento',
        'medidasok',
        'compartida',
        'ocupada',
        'vigente'
    ];



}
