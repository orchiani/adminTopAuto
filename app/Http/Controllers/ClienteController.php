<?php

namespace App\Http\Controllers;
use App\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
       $buscar = $request->buscar;
       if($buscar==''){
        $clientes = Cliente::orderBy('codigo', 'asc')->paginate(20);
       }
       else{
           $clientes = Cliente::where(DB::raw("CONCAT(`codigo`, `nombre_fantasia`, `razon_social`)"), 'like', "%" . $buscar . "%")->orderBy('codigo', 'asc')->paginate(20);
       }

        return [
            'pagination' => [
                'total' => $clientes->total(),
                'current_page' => $clientes->currentPage(),
                'per_page' => $clientes->perPage(),
                'last_page' => $clientes->lastPage(),
                'from' => $clientes->firstItem(),
                'to' => $clientes->lastItem(),
            ],
            'clientes' => $clientes
        ];
    }




    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->codigo = $request->codigo;
        $cliente->nombre_fantasia = $request->nombre_fantasia;
        $cliente->razon_social = $request->razon_social;
        $cliente->id_provincia = $request->id_provincia;
        $cliente->id_iva = $request->id_iva;
        $cliente->id_localidad = $request->id_localidad;
        $cliente->email = $request->email;
        $cliente->web = $request->web;
        $cliente->cuenta = $request->cuenta;
        $cliente->cuit = $request->cuit;
        $cliente->telefono = $request->telefono;
        $cliente->telefono2 = $request->telefono2;
        $cliente->direccion = $request->direccion;
        $cliente->codigo_postal = $request->codigo_postal;
        $cliente->save();
    }



    public function update(Request $request)
    {
        $codigo = $request->codigo;

        $result = DB::table('clientes')
             ->where('codigo', $codigo)
             ->update($request->only(['nombre_fantasia', 'razon_social', 'id_provincia', 'id_iva', 'id_localidad', 'email', 'web', 'cuenta', 'cuit', 'telefono', 'telefono2', 'direccion', 'codigo_postal']));
    }

}
