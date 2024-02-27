<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'nombre', 'vigente'];


    public function ciudads():HasMany
    {
        return $this->hasMany(Ciudad::class);
        //return $this->hasMany('App\Models\Ciudad', 'region_id', 'id');
    }

    //public function ciudads(): HasMany
    //{
    //    return $this->hasMany(Ciudad::class);
    //}
}
