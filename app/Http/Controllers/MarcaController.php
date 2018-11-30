<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Marca;

class MarcaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
       $buscar = $request->buscar;
       if($buscar==''){
        $marcas = Marca::orderBy('codigo', 'asc')->paginate(100);
       }
       else{
           $marcas = Marca::where(DB::raw("CONCAT(`codigo`, `nombre`)"), 'like', "%" . $buscar . "%")->orderBy('codigo', 'asc')->paginate(100);
       }

        return [
            'pagination' => [
                'total' => $marcas->total(),
                'current_page' => $marcas->currentPage(),
                'per_page' => $marcas->perPage(),
                'last_page' => $marcas->lastPage(),
                'from' => $marcas->firstItem(),
                'to' => $marcas->lastItem(),
            ],
            'marcas' => $marcas
        ];
    }

    public function store(Request $request)
    {
        $marca = new Marca();
        $marca->codigo = $request->codigo;
        $marca->nombre = $request->nombre;
        $marca->save();
    }

    public function update(Request $request)
    {
        $codigo = $request->codigo;

        $result = DB::table('marcas')
             ->where('codigo', $codigo)
             ->update($request->only(['codigo', 'nombre']));

    }

}
