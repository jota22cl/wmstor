<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Productoperiodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'periodo',
        'saldo_ini',
        'entradas',
        'salidas',
    ];


    public function producto():BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }



}
