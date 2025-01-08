<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'contrato_id',
        'codigo',
        'descripcion',
        'unimed_ingreso_id',
        'unimed_salida_id',
        'factor_conversion',
        'codbarra_cliente',
        'codbarra_bodega',
        'codbarra_ean13',
        'codbarra_dun14',
        'lote',
        'fechacaducidad',
        'numeral_id',
        'inventariable',
        'saldoInicial',
        'totalEntradas',
        'totalSalidas',
        'reservado',
        'vigente'
    ];


    public function contrato():BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

    public function unimed_ingreso():BelongsTo
    {
        return $this->belongsTo(Unimedida::class, 'unimed_ingreso_id');
    }

    public function unimed_salida():BelongsTo
    {
        return $this->belongsTo(Unimedida::class, 'unimed_salida_id');
    }


}
