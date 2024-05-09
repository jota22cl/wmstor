<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;


    protected $fillable = [
        'rut',
        'nombre',
        'sigla',
        'giro',
        'direccion',
        'comuna_id',
        'telefono',
        'email',
        'observacion',
        'vigente'
    ];

    public function comuna():BelongsTo
    { 
        return $this->belongsTo(Comuna::class);
    }

}
