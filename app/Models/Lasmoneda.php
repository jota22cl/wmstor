<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lasmoneda extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id','codigo','simbolo','vigente'];


    public function empresa():BelongsTo
    { 
        return $this->belongsTo(Empresa::class);
    }
}
