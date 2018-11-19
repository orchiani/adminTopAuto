<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Route::get('/', 'Auth\LoginController@showLoginform');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/producto', 'ProductoController@index');
    Route::get('/producto/fragancias', 'ProductoController@fraganciasProducto');
    Route::post('/producto/agregar', 'ProductoController@store');
    Route::post('/producto/actualizar', 'ProductoController@update');
    Route::get('/categoria', 'CategoriaController@index');
    Route::post('/categoria/agregar', 'CategoriaController@store');
    Route::post('/categoria/actualizar', 'CategoriaController@update');
    Route::get('/provincias', 'ProvinciasController@index');
    Route::get('/localidades', 'LocalidadesController@index');
    Route::get('/talles', 'TallesController@index');
    Route::get('/condicionesdeiva', 'CondicionesDeIvaController@index');
    Route::get('/zonas', 'ZonasController@index');
    Route::get('/fragancia', 'FraganciaController@index');
    Route::post('/fragancia/agregar', 'FraganciaController@store');
    Route::post('/fragancia/actualizar', 'FraganciaController@update');
    Route::get('/cliente', 'ClienteController@index');
    Route::post('/cliente/agregar', 'ClienteController@store');
    Route::post('/cliente/actualizar', 'ClienteController@update');
    Route::get('/marca', 'MarcaController@index');
    Route::post('/marca/agregar', 'MarcaController@store');
    Route::post('/marca/actualizar', 'MarcaController@update');
    Route::get('/user', 'UserController@index');
    Route::post('/user/agregar', 'UserController@store');
    Route::post('/user/actualizar', 'UserController@update');
    Route::get('/pedidos', 'PedidosController@index');
    Route::get('/pedidos/cabecera', 'PedidosController@obtenerCabecera');
    Route::get('/pedidos/detalles', 'PedidosController@obtenerDetalles');
    Route::post('/pedidos/actualizar', 'PedidosController@update');
    Route::get('/pedidos/pdf/{id}', 'PedidosController@pdf')->name('venta_pdf');
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');



Route::get('/home', 'HomeController@index')->name('home');
