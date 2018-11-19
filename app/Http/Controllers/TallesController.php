<?php

namespace App\Http\Controllers;
use App\Talles;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TallesController extends Controller
{

    public function index(Request $request)
    {
        
      
           $talles = Talles::all();
       
        
        return [
            'talles' => $talles
        ];
    }

}

