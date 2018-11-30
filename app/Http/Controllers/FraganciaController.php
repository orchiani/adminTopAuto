<?php

namespace App\Http\Controllers;
use App\Fragancia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FraganciaController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
       $buscar = $request->buscar;
       if($buscar==''){
        $fragancias = Fragancia::orderBy('codigo', 'asc')->paginate(100);
       }
       else{
           $fragancias = Fragancia::where(DB::raw("CONCAT(`codigo`, `nombre`)"), 'like', "%" . $buscar . "%")->orderBy('codigo', 'asc')->paginate(100);
       }

        return [
            'pagination' => [
                'total' => $fragancias->total(),
                'current_page' => $fragancias->currentPage(),
                'per_page' => $fragancias->perPage(),
                'last_page' => $fragancias->lastPage(),
                'from' => $fragancias->firstItem(),
                'to' => $fragancias->lastItem(),
            ],
            'fragancias' => $fragancias
        ];
    }

    public function store(Request $request)
    {
        $fragancia = new Fragancia();
        $fragancia->codigo = $request->codigo;
        $fragancia->nombre = $request->nombre;
        $fragancia->save();
    }

    public function update(Request $request)
    {
        $codigo = $request->codigo;

        $result = DB::table('fragancias')
             ->where('codigo', $codigo)
             ->update($request->only(['nombre']));

    }


}
