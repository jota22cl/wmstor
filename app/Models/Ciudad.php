<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

//use Illuminate\Database\Eloquent\Relations\HasMany;
//use Illuminate\Database\Eloquent\Relations\HasOne;

class Ciudad extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','region_id','vigente'];



    public function region():BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function comunas():HasMany
    {
        return $this->hasMany(Comuna::class);
        //return $this->hasMany('App\Models\Ciudad', 'region_id', 'id');
    }

    ///**
    // * @return \Illuminate\Database\Eloquent\Relations\HasMany
    // */
    //public function comunas()
    //{
    //    return $this->hasMany('App\Models\Comuna', 'ciudad_id', 'id');
    //}
    
    ///**
    // * @return \Illuminate\Database\Eloquent\Relations\HasOne
    // */
    //public function region()
    //{
    //    return $this->hasOne('App\Models\Region', 'id', 'region_id');
    //}



    //public function comunas(): HasMany
    //{
    //    return $this->hasMany(Comuna::class);
    //}
    
    //public function region()
    //{
    //    return $this->hasOne(Region::class);
    //}

}
