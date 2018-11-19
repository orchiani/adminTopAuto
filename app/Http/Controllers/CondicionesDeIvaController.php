<?php

namespace App\Http\Controllers;
use App\CondicionesDeIva;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CondicionesDeIvaController extends Controller
{
    public function index(Request $request)
    {
        
      
           $condiciones = DB::table('condicionesiva')->select()->get();
       
        
        return [
            'condicionesdeiva' => $condiciones
        ];
    }
}
