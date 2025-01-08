<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Valorservicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'fecha',
        'ccosto_id',
        'servicio_id',
        'valor',
        'lafecha',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    
    public function ccosto():BelongsTo
    {
        return $this->belongsTo(Ccosto::class);
    }

    public function servicio():BelongsTo
    {
        return $this->belongsTo(Servicio::class);
    }
}

