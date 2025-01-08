<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'cliente_id',
        'ccosto_id',
        'bodega_id',
        'vendedor_id',
        'folioContrato',
        'fecha_ini',
        'fecha_fin',
        'estado',
        'observacion',
        'tipoArriendo',
        'valorArriendo',
        'montoMinimo',
        'unimedMinimo',
        'gastosComunes_id',
        'gastosAdministracion_id',
        'primaSeguro_id',
        'monedaMontoAsegurado_id',
        'montoAsegurado',
        'montoGarantia',
        'garantiaPago',
        'garantiaReciboGenerado',
        'garantiaMontoPago',
        'garantiaFechaPago',
        'garantiaObservacionPago',
        'garantiaDevolucion',
        'garantiaMontoDevolucion',
        'garantiaFechaDevolucion',
        'garantiaObservacionDevolucion',
        'vigente',
    ];


    
    /************************************************ */
    /*************** varios registros *************** */
    /************************************************ */
    public function contratoreplegals():HasMany {
        return $this->hasMany(Contratoreplegal::class);
    }

    public function contratopagoproveedors():HasMany {
        return $this->hasMany(Contratopagoproveedor::class);
    }

    public function contratodtemails():HasMany {
        return $this->hasMany(Contratodtemail::class);
    }
    
    public function contratoguiamails():HasMany {
        return $this->hasMany(Contratoguiamail::class);
    }

    public function contratocoordinadors():HasMany {
        return $this->hasMany(Contratocoordinador::class);
    }

    public function contratoautretiros():HasMany {
        return $this->hasMany(Contratoautretiro::class);
    }

    public function contratodocumentos():HasMany {
        return $this->hasMany(Contratodocumento::class);
    }

    public function contratovalors():HasMany {
        return $this->hasMany(Contratovalor::class);
    }

    public function productos():HasMany {
        return $this->hasMany(Producto::class);
    }

    /******************************************* */
    /*************** un registro *************** */
    /******************************************* */
    public function cliente():BelongsTo { 
        return $this->belongsTo(Cliente::class);
    }

    public function ccosto():BelongsTo { 
        return $this->belongsTo(Ccosto::class);
    }

    public function bodega():BelongsTo { 
        //return $this->belongsTo(Bodega::class);
        return $this->belongsTo(Bodega::class, 'bodega_id');
    }

    public function empresa():BelongsTo { 
        return $this->belongsTo(Empresa::class);
    }

    public function gcomun():BelongsTo { 
        return $this->belongsTo(Gcomun::class, 'gastosComunes_id');
    }

    public function gadmin():BelongsTo { 
        return $this->belongsTo(Gadmin::class, 'gastosAdministracion_id');
    }

    public function pseguro():BelongsTo { 
        return $this->belongsTo(Pseguro::class, 'primaSeguro_id');
    }

    public function monedaSeguro():BelongsTo { 
        return $this->belongsTo(Moneda::class, 'monedaMontoAsegurado_id');
    }

//    public function producto():BelongsTo { 
//        return $this->belongsToProducto::class, 'monedaMontoAsegurado_id');
//    }



    //public function comuna():BelongsTo { 
    //    return $this->belongsTo(Comuna::class);
    //}

}
