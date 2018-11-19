<?php

namespace App\Http\Controllers;
use App\Provincias;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProvinciasController extends Controller
{
    public function index(Request $request)
    {
        
      
           $provincias = Provincias::all();
       
        
        return [
            'provincias' => $provincias
        ];
    }
}
