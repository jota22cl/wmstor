<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'imprimeEnContrato',
        'vigente'
    ];

    public function empresa():BelongsTo { 
        return $this->belongsTo(Empresa::class);
    }

    public function servicios():HasMany {
        return $this->hasMany(Servicio::class);
    }
    
    public function uni_ingreso():BelongsTo { 
        return $this->belongsTo(Unimedida::class, 'unimed_ingreso_id');
    }
    public function uni_cobro():BelongsTo { 
        return $this->belongsTo(Unimedida::class, 'unimed_cobro_id');
    }
}
