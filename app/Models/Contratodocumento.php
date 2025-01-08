<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratodocumento extends Model
{
    use HasFactory;

    protected $fillable = [
        'contrato_id',
        'tipo',
        'observacion',
        'documento',
    ];

    public function contrato():BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

}
