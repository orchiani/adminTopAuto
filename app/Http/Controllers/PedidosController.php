<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Pedidos;



class PedidosController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
           if($buscar==''){
            $pedidos = DB::table('pedidoscab')->join('users','pedidoscab.id_vendedor','=','users.id')-> join('clientes','pedidoscab.id_cliente','=','clientes.codigo')
            ->select('pedidoscab.id_transaccion','pedidoscab.numero','clientes.razon_social as id_cliente','users.nombre as id_vendedor','pedidoscab.total','pedidoscab.id_mpago','pedidoscab.controlado','pedidoscab.descuento','pedidoscab.notas','pedidoscab.created_at','pedidoscab.updated_at','pedidoscab.id_condpago')
            ->orderBy('controlado','asc')->paginate(50);
           }
           else{
               $pedidos = DB::table('pedidoscab')->where(DB::raw("CONCAT(`numero`)"), 'like', "%" . $buscar . "%")->orderBy('id_transaccion', 'asc')->paginate(50);
           }


            return [
                'pagination' => [
                    'total' => $pedidos->total(),
                    'current_page' => $pedidos->currentPage(),
                    'per_page' => $pedidos->perPage(),
                    'last_page' => $pedidos->lastPage(),
                    'from' => $pedidos->firstItem(),
                    'to' => $pedidos->lastItem(),
                ],
                'pedidos' => $pedidos
            ];
        }

        public function update(Request $request)
        {
            $codigo = $request->transaccion;

            $result = DB::table('pedidoscab')
                 ->where('id_transaccion', $codigo)
                 ->update($request->only(['controlado']));

        }

        public function obtenerCabecera(Request $request){
            $transaccion = $request->transaccion;
            $pedido = DB::table('pedidoscab')->join('clientes', 'pedidoscab.id_cliente', 'clientes.codigo')
            ->join('users', 'pedidoscab.id_vendedor', 'users.id')
            ->join('medios_de_pago', 'pedidoscab.id_mpago', 'medios_de_pago.codigo')
            ->select('pedidoscab.created_at', 'pedidoscab.numero', 'pedidoscab.total', 'pedidoscab.controlado', 'pedidoscab.descuento', 'clientes.razon_social', 'users.usuario', 'medios_de_pago.nombre','pedidoscab.notas')
            ->where('pedidoscab.id_transaccion', '=', $transaccion)
            ->orderBy('pedidoscab.id_transaccion', 'desc')->get();

            return ['pedido' => $pedido];
        }

        public function obtenerDetalles(Request $request){
            $transaccion = $request->transaccion;
            $detalles = DB::table('pedidosdet')->join('productos', 'pedidosdet.articulo', 'productos.codigo')
            ->select('pedidosdet.cantidad', 'pedidosdet.precio', 'productos.descripcion')
            ->where('pedidosdet.transaccion', '=', $transaccion)
            ->orderBy('pedidosdet.transaccion', 'desc')->get();

            return ['detalles' => $detalles];
        }

        public function pdf(Request $request, $transaccion){
            $cabecera = DB::table('pedidoscab')->join('clientes', 'pedidoscab.id_cliente', 'clientes.codigo')
            ->join('users', 'pedidoscab.id_vendedor', 'users.id')
            ->join('medios_de_pago', 'pedidoscab.id_mpago', 'medios_de_pago.codigo')
            ->select('pedidoscab.created_at', 'pedidoscab.numero', 'pedidoscab.total', 'pedidoscab.controlado', 'pedidoscab.descuento', 'clientes.razon_social', 'clientes.cuit', 'clientes.telefono', 'clientes.direccion', 'clientes.id_iva', 'clientes.email', 'clientes.cuenta', 'users.usuario', 'medios_de_pago.nombre','pedidoscab.notas')
            ->where('pedidoscab.id_transaccion', '=', $transaccion)->get();

            $detalles =  DB::table('pedidosdet')->join('productos', 'pedidosdet.articulo', 'productos.codigo')
            ->select('pedidosdet.articulo as codigo', 'pedidosdet.cantidad as cantidad', 'pedidosdet.precio as precio', 'productos.descripcion as producto')
            ->where('pedidosdet.transaccion', '=', $transaccion)
            ->orderBy('pedidosdet.transaccion', 'desc')->get();

            $numpedido = DB::table('pedidoscab')->select('numero')->where('id_transaccion', '=', $transaccion)->get();
            $pdf = \PDF::loadView('pdf.venta', ['cabecera' =>$cabecera, 'detalles'=>$detalles]);
            return $pdf->download('Pedido-'.$numpedido[0]->numero.'.pdf');
        }

}
