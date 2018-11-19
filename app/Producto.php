<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $fillable = ['codigo', 'descripcion', 'descripcion_adicional', 'marca', 'categoria', 'precio', 'precio2', 'precio3', 'activo', 'imagen', 'oferta_volumen', 'envase_nuevo', 'escala_descuento', 'oferta_lanzamiento', 'agotar_stock', 'embarque', 'fragancias', 'talles'];
   
    public function fragancias(){
        return $this->belongsToMany('App\Fragancia', 'fraganciasxarticulo', 'id_articulo', 'id_fragancia');
    }

    public function talles(){
        return $this->belongsToMany('App\Talles', 'tallesxarticulo', 'id_articulo', 'id_talle');
    }

  

}
