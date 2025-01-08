<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\ValidationException;

class Guia extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'contrato_id',
        'guia', //['i' = Guia de Ingreso,  's' = Guia de Salida]
        'tipoGuia', //['n' = Guia NORMAL,  'ab' = Ajuste Bodega,  'ac' = Ajuste Cliente]
        'numeroGuia',
        'fechaGuia',
        'fechaDigitacion',
        'periodo',
        'contratoautretiro_id',
        'empresatransporte',
        'patente',
        'choferRut',
        'choferNombre',
        'correoCliente',
        'guiaCliente',
        'factCliente',
        'user_id',
        'operario_id',
        'observacion',
        'estado'    //['digitado', 'emitido']
    ];


    public function empresa():BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function contrato():BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

    public function bodeguero():BelongsTo
    {
        return $this->belongsTo(Bodeguero::class);
    }

    public function userDigitador():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

//    public function productos():HasMany
//    {
//        return $this->hasMany(Producto::class);
//    }

    public function guiadetalles():HasMany
    {
        //return $this->hasMany(Guiadetalle::class)->with('producto');
        return $this->hasMany(Guiadetalle::class);
    }
}
