<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratodtemail extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
    ];

    public function contrato():BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

}
