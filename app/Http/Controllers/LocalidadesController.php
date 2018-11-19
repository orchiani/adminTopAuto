<?php

namespace App\Http\Controllers;
use App\Localidades;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LocalidadesController extends Controller
{
    public function index(Request $request)
    {
        
      
           $localidades = Localidades::all();
       
        
        return [
            'localidades' => $localidades
        ];
    }
}
