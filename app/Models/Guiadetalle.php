<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guiadetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'contrato_id',
        'guia_id',
        'periodo',
        'producto_id',
        'cantidad',
        'factor'
    ];


    public function empresa():BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function guia():BelongsTo
    {
        return $this->belongsTo(Guia::class);
    }

    public function contrato():BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }
    
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    //public function guia(): HasMany
    //{
    //    return $this->hasMany(Guia::class, 'guia_id');
    //}

    
}
