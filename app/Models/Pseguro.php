<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pseguro extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'codigo',
        'descripcion',
        'valor',
        'periodoInicial',
        'periodoFinal',
        'polizaSeguro',
        'ciaSeguro',
        'montoDeducibleRoboIncendio',
        'monedaDeducibleRoboIncendio_id',
        'montoDeducibleTerremoto',
        'monedaDeducibleTerremoto_id',
        'vigente'
    ];

    public function empresa():BelongsTo {
        return $this->belongsTo(Empresa::class);
    }

    public function monedaDeducibleRoboIncendio():BelongsTo { 
        return $this->belongsTo(moneda::class, 'monedaDeducibleRoboIncendio_id');
    }

    public function monedaDeducibleTerremoto():BelongsTo { 
        return $this->belongsTo(moneda::class, 'monedaDeducibleTerremoto_id');
    }

}
