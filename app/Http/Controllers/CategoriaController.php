<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Categoria;

class CategoriaController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
       $buscar = $request->buscar;
       if($buscar==''){
        $categorias = Categoria::orderBy('codigo', 'asc')->paginate(20);
       }
       else{
           $categorias = Categoria::where(DB::raw("CONCAT(`codigo`, `nombre`)"), 'like', "%" . $buscar . "%")->orderBy('codigo', 'asc')->paginate(20);
       }

        return [
            'pagination' => [
                'total' => $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page' => $categorias->perPage(),
                'last_page' => $categorias->lastPage(),
                'from' => $categorias->firstItem(),
                'to' => $categorias->lastItem(),
            ],
            'categorias' => $categorias
        ];
    }

    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->codigo = $request->codigo;
        $categoria->nombre = $request->nombre;
        $categoria->save();
    }

    public function update(Request $request)
    {
        $codigo = $request->codigo;

        $result = DB::table('categorias')
             ->where('codigo', $codigo)
             ->update($request->only(['nombre']));

    }

}
