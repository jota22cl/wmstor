<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ccosto extends Model
{
    use HasFactory;

    protected $fillable = ['codigo','descripcion','vigente'];
}
