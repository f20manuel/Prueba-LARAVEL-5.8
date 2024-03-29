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

Route::get('/', function () {
    return view('auth.login');
});

//Empresas
Route::resource('empresas', 'EmpresasController')->middleware('permission:empresas');
Route::post('/buscar/empresas', 'EmpresasController@search')->name('empresasSearch');

//Empresas
Route::resource('empleados', 'EmpleadosController')->middleware('permission:empleados');
Route::post('/buscar/empleados', 'EmpleadosController@search')->name('empleadosSearch');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
