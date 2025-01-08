<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratovalor extends Model
{
    use HasFactory;

    protected $fillable = [
        'contrato_id',
        'servicio_id',
        'fecha',
        'valor',
    ];

    public function contrato():BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }
}
