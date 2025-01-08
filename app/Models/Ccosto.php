<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ccosto extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'codigo',
        'descripcion',
        'inventario',
        'garantia',
        'numeral',
        'vigente'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'ccosto_user');
    }
    
//    public function scopeDeLaEmpresa($query, $empresaId)
//    {
//        return $query->where('empresa_id', $empresaId);
//    }

}
