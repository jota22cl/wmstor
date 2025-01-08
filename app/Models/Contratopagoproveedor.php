<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratopagoproveedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'contrato_id',
        'nombre',
        'telefono',
        'celular',
        'email',
    ];

    public function contrato():BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

}
