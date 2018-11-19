<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'nombre_fantasia', 'razon_social', 'id_provincia', 'id_iva', 'id_localidad', 'email', 'web', 'cuenta', 'cuit', 'telefono', 'telefono2', 'direccion', 'codigo_postal'
    ];

    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

    }