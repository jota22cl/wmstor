<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id','codigo','simbolo','vigente'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
