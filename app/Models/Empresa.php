<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'razonsocial',
        'sigla',
        'rut',
        'giro',
        'direccion',
        'comuna_id',
        'telefono',
        'email',
        'repl_nombre',
        'repl_rut',
        'repl_telefono',
        'repl_email',
        'logo',
        'vigente'
    ];


    public function comuna():BelongsTo
    {
        return $this->belongsTo(Comuna::class);
    }

    

    // uns empresa puede tener muchos ..... usuarios, monedas, etc
    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }
}
