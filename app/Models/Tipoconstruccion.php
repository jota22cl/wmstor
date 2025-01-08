<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoconstruccion extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id','empresa_id','codigo','vigente'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
