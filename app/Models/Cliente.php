<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;


    protected $fillable = [
        'empresa_id',
        'rut',
        'nombre',
        'sigla',
        'giro',
        'direccion',
        'comuna_id',
        'telefono',
        'celular',
        'email',
        'observacion',
        'vigente'
    ];

    public function comuna():BelongsTo
    { 
        return $this->belongsTo(Comuna::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'cliente_id');
    }



    // Lista de atributos que deben estar en mayúsculas
    protected $uppercaseAttributes = [
        'nombre',
        'sigla',
        'giro',
        'direccion',
        'email',
//        'observacion'
    ];



    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->uppercaseAttributes)) {
            if ($key === 'observacion') {
                // Convert only the text content to uppercase, keeping the HTML tags intact
                $value = preg_replace_callback('/(<[^>]*>|\s)([^<]*)(?=<[^>]*>|\s|$)/', function ($matches) {
                    return $matches[1] . strtoupper($matches[2]);
                }, $value);
            } else {
                $value = strtoupper($value);
            }
        }
        return parent::setAttribute($key, $value);
    }
/*
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->uppercaseAttributes)) {
            $value = strtoupper($value);
        }
        return parent::setAttribute($key, $value);
    }
*/

    public function setObservacionAttribute($value)
    {
        $this->attributes['observacion'] = strtoupper($value);
    }


}
