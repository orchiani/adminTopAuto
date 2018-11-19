<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Zonas;

class ZonasController extends Controller
{
    public function index(Request $request)
    {
        
      
           $zonas = Zonas::all();
       
        
        return [
            'zonas' => $zonas
        ];
    }
}
