<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'usuario', 'password', 'id_rol', 'activo'. 'imagen'
    ];

    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'password', 'remember_token',
    ];

    public function rol(){
        return $this->belongsTo('App\Rol');
    }

    public function zonas(){
        return $this->belongsToMany('App\Zonas', 'zonasxvendedor', 'id_vendedor', 'id_zona');
    }
}
