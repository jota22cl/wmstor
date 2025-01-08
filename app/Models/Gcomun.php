<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gcomun extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id','codigo','descripcion','valor','vigente'];

    public function empresa():BelongsTo { 
        return $this->belongsTo(Empresa::class);
    }


    public function contratos():HasMany {
        return $this->hasMany(Contrato::class);
    }

}
