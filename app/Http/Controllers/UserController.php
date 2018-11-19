<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request){
        //if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;

        if($buscar==''){
            $users = User::orderBy('id', 'asc')->paginate(20);
        } else {
            $users = User::where(DB::raw("CONCAT(`nombre`, `usuario`)"), 'like', "%" . $buscar . "%")->orderBy('id', 'asc')->paginate(20);
        }

        return [
            'pagination' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
            ],
            'usuarios' => $users
        ];
    }

    public function store(Request $request){
        if(!$request->ajax()) return redirect('/');

        if($request->image){
            $exploded = explode(',', $request->image);
           $decoded = base64_decode($exploded[1]);
           if(str_contains($exploded[0], 'jpeg')){
               $extension = 'jpg';
           }else{
               $extension = 'png';
           }

           $filename = str_random().'.'.$extension;
           $path = public_path().'/img/usuarios/'.$filename;
           file_put_contents($path, $decoded);

        try{
            DB::beginTransaction();
            $user = new User();
            $user->nombre = $request->nombre;
            $user->usuario = $request->usuario;
            $user->password = bcrypt($request->password);
            $user->activo = $request->activo;
            $user->id_rol = $request->id_rol;
            $user->imagen = $filename;
            $zonas = $request->zonas;
            $user->zonas()->sync($zonas);
            $user->save();
            DB::commit();
        } catch (Exception $exc){
            return $exc;
        }
    } else {
        try{
            DB::beginTransaction();
            $user = new User();
            $user->nombre = $request->nombre;
            $user->usuario = $request->usuario;
            $user->password = bcrypt($request->password);
            $user->activo = $request->activo;
            $user->id_rol = $request->id_rol;
            $zonas = $request->zonas;
            $user->zonas()->sync($zonas);
            $user->save();
            DB::commit();
        } catch (Exception $exc){
            return $exc;
        }
    }
}

    public function update (Request $request){
        if(!$request->ajax()) return redirect('/');

        if($request->image){
            $exploded = explode(',', $request->image);
           $decoded = base64_decode($exploded[1]);
           if(str_contains($exploded[0], 'jpeg')){
               $extension = 'jpg';
           }else{
               $extension = 'png';
           }

           $filename = str_random().'.'.$extension;
           $path = public_path().'/img/usuarios/'.$filename;
           file_put_contents($path, $decoded);

        $id = $request->id;
            $result = DB::table('users')
            ->where('id', $id)
            ->update(['nombre' => $request->nombre, 'usuario' => $request->usuario, 'password' => bcrypt($request->password), 'id_rol' => $request->id_rol, 'activo' => $request->activo, 'imagen' => $filename ]
    );
     } else{
        $id = $request->id;
        $result = DB::table('users')
        ->where('id', $id)
        ->update(['nombre' => $request->nombre, 'usuario' => $request->usuario, 'password' => bcrypt($request->password), 'id_rol' => $request->id_rol, 'activo' => $request->activo ]
);
        $id1 = $request->id;
        $zonas = $request->zonas;
        $user = User::find($id1)->zonas()->sync($zonas);

     }

    $id = $request->id;
    $zonas = $request->zonas;
    $user = User::find($id)->zonas()->sync($zonas);
    }
}
