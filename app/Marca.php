<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
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
    
    public function productos(){
        return $this->hasMany('App\Producto');
    }
    
    }