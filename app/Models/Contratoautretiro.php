<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contratoautretiro extends Model
{
    use HasFactory;

    protected $fillable = [
        'contrato_id',
        'nombre',
        'rut',
        'telefono',
        'celular',
        'email',
    ];


    public function contrato():BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

}
