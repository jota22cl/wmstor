<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gadmin extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id','codigo','descripcion','valor','vigente'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
