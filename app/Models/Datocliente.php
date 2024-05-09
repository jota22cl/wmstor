<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datocliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'tipo',
        'nombre',
        'rut',
        'email',
        'telefono'
    ];
    
}
