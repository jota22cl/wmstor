<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasOne;

class Comuna extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','ciudad_id','vigente'];

    
    public function ciudad():BelongsTo
    { 
        return $this->belongsTo(Ciudad::class);
    }

    
    
    public function empresas():HasMany
    {
        return $this->hasMany(Empresa::class);
    }

    public function clientes():HasMany
    {
        return $this->hasMany(Clientes::class);
    }

}
