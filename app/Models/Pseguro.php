<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pseguro extends Model
{
    use HasFactory;

    protected $fillable = ['codigo','descripcion','valor','vigente'];
}
