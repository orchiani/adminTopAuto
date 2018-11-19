<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Producto;
use  App\Fragancia;
use App\Quotation;

class ProductoController extends Controller
{

    public function index(Request $request)
    {

       $buscar = $request->buscar;
       if($buscar==''){
        $productos = Producto::orderBy('codigo', 'asc')->paginate(20);
       }
       else{
           $productos = Producto::where(DB::raw("CONCAT(`codigo`, `descripcion`, `descripcion_adicional`)"), 'like', "%" . $buscar . "%")->orderBy('codigo', 'asc')->paginate(20);
       }


        return [
            'pagination' => [
                'total' => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page' => $productos->perPage(),
                'last_page' => $productos->lastPage(),
                'from' => $productos->firstItem(),
                'to' => $productos->lastItem(),
            ],
            'productos' => $productos
        ];
    }

    public function store(Request $request)
    {

        if($request->image){
         $exploded = explode(',', $request->image);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpeg')){
            $extension = 'jpg';
        }else{
            $extension = 'png';
        }

        $filename = str_random().'.'.$extension;
        $path = public_path().'/img/productos/'.$filename;
        file_put_contents($path, $decoded);


        $producto = new Producto();
        $producto->codigo = $request->codigo;
        $producto->descripcion = $request->descripcion;
        $producto->descripcion_adicional = $request->descripcion_adicional;
        $producto->id_marca = $request->id_marca;
        $producto->id_categoria = $request->id_categoria;
        $producto->precio = $request->precio;
        $producto->precio2 = $request->precio2;
        $producto->precio3 = $request->precio3;
        $producto->activo = $request->activo;
        $producto->imagen = $filename;
        $producto->oferta_volumen = $request->oferta_volumen;
        $producto->envase_nuevo = $request->envase_nuevo;
        $producto->escala_descuento = $request->escala_descuento;
        $producto->oferta_lanzamiento = $request->oferta_lanzamiento;
        $producto->agotar_stock = $request->agotar_stock;
        $fragancias = $request->fragancias;
        $talles = $request->talles;
        $producto->fragancias()->sync($fragancias);
        $producto->talles()->sync($talles);
        $producto->embarque = $request->embarque;
        $producto->save();
    }else{

        $producto = new Producto();
        $producto->codigo = $request->codigo;
        $producto->descripcion = $request->descripcion;
        $producto->descripcion_adicional = $request->descripcion_adicional;
        $producto->id_marca = $request->id_marca;
        $producto->id_categoria = $request->id_categoria;
        $producto->precio = $request->precio;
        $producto->precio2 = $request->precio2;
        $producto->precio3 = $request->precio3;
        $producto->activo = $request->activo;
        $producto->oferta_volumen = $request->oferta_volumen;
        $producto->envase_nuevo = $request->envase_nuevo;
        $producto->escala_descuento = $request->escala_descuento;
        $producto->oferta_lanzamiento = $request->oferta_lanzamiento;
        $producto->agotar_stock = $request->agotar_stock;
        $producto->embarque = $request->embarque;
        $fragancias = $request->fragancias;
        $talles = $request->talles;
        $producto->fragancias()->sync($fragancias);
        $producto->talles()->sync($talles);
        $producto->save();
      }

    }

    public function update(Request $request)
    {
        $codigo = $request->codigo;

        if($request->image){
            $exploded = explode(',', $request->image);
           $decoded = base64_decode($exploded[1]);
           if(str_contains($exploded[0], 'jpeg')){
               $extension = 'jpg';
           }else{
               $extension = 'png';
           }


        $filename = str_random().'.'.$extension;
        $path = public_path().'/img/productos/'.$filename;
        file_put_contents($path, $decoded);

        $result = DB::table('productos')
             ->where('codigo', $codigo)
             ->update($request->only(['descripcion', 'descripcion_adicional', 'id_marca', 'id_categoria', 'suspendido', 'precio', 'precio2', 'precio3', 'oferta_volumen', 'envase_nuevo', 'escala_descuento', 'oferta_lanzamiento', 'agotar_stock', 'embarque']));
        $result = DB::table('productos')
             ->where('codigo', $codigo)
             ->update(['imagen' => $filename]);

     $product = DB::table('productos')
    ->where('codigo', $codigo);

    $fragancias = $request->fragancias;
    $talles = $request->talles;
    $product = Producto::find($codigo)->fragancias()->sync($fragancias);
    $product1 = Producto::find($codigo)->talles()->sync($talles);
    }

    $codigo = $request->codigo;

    $result = DB::table('productos')
    ->where('codigo', $codigo)
    ->update($request->only(['descripcion', 'descripcion_adicional', 'id_marca', 'id_categoria', 'suspendido', 'precio', 'precio2', 'precio3', 'oferta_volumen', 'envase_nuevo', 'escala_descuento', 'oferta_lanzamiento', 'agotar_stock', 'embarque']));

    $fragancias = $request->fragancias;
    $talles = $request->talles;
    $product = Producto::find($codigo)->fragancias()->sync($fragancias);
    $product1 = Producto::find($codigo)->talles()->sync($talles);

}

public function fraganciasProducto(Request $request){
    $codigo = $request->codigo;
    $f = DB::table('fraganciasxarticulo')->where('id_articulo', $codigo)->get();
    return [
        'fragancias' => $f
    ];
}

}
