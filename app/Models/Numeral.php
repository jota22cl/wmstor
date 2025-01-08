<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numeral extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'ccosto_id',
        'codigo',
        'descripcion',
        'vigente'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function ccosto()
    {
        return $this->belongsTo(Ccosto::class);
    }

}
