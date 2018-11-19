<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $primaryKey = 'id_transaccion';
    protected $fillable = ['numero', 'id_cliente', 'id_vendedor', 'total', 'id_mpago', 'controlado', 'descuento', 'notas'];
   
    public function detalles(){
        return $this->hasMany('App\Detalles', 'pedidosdet', 'transaccion');
    }

}
