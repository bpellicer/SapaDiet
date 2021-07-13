<?php

use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistre;
use App\Http\Controllers\ControladorPerfil;
use App\Http\Controllers\ControladorPlanificacio;
use Illuminate\Support\Facades\Route;

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
    return view('pages.home');
});

Route::get('registre', [ControladorRegistre::class, 'create'])->middleware('guest');

Route::post('registre', [ControladorRegistre::class, 'store'])->middleware('guest');

Route::get('login', [ControladorLogin::class, 'create'])->middleware('guest');

Route::post('login', [ControladorLogin::class, 'store'])->middleware('guest');

Route::post('logout',[ControladorLogin::class, 'destroy'])->middleware('auth');

Route::get('perfil',[ControladorPerfil::class, 'create'])->middleware('auth');

Route::post('updatePerfil',[ControladorPerfil::class,'update'])->middleware('auth');

Route::post('esborraUsuari', [ControladorPerfil::class, 'delete'])->middleware('auth');

Route::post('updateImatgePerfil',[ControladorPerfil::class, 'updateImatgePerfil'])->middleware('auth');

Route::get('planificacio', [ControladorPlanificacio::class, 'create'])->middleware('auth');
