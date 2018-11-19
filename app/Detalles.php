<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalles extends Model
{
   
    protected $fillable = ['transaccion', 'articulo', 'cantidad', 'precio'];
   
    public function cabecera(){
        return $this->hasOne('App\Pedidos', 'pedidoscab', 'id_transaccion');
    }
}
