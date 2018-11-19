<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zonas extends Model
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
    

    public function users(){
        return $this->belongsToMany('App\User', 'zonasxvendedor', 'id_zona', 'id_vendedor');
    }
}