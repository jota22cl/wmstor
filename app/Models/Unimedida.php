<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unimedida extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id','codigo','descripcion','vigente'];
}
