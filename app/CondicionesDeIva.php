<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CondicionesDeIva extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'codigo'
    ];
    
    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
}
