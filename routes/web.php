<?php

use App\Http\Controllers\ControladorAliment;
use App\Http\Controllers\ControladorBuscador;
use App\Http\Controllers\ControladorCalendari;
use App\Http\Controllers\ControladorDieta;
use App\Http\Controllers\ControladorLlistesCompra;
use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistre;
use App\Http\Controllers\ControladorPerfil;
use App\Http\Controllers\ControladorPlanificacio;
use App\Http\Controllers\ControladorProgres;
use App\Http\Controllers\ControladorResetPassword;
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

Route::middleware(['auth'])->group(function () {
    Route::post('logout',[ControladorLogin::class, 'destroy']);

    Route::get('perfil',[ControladorPerfil::class, 'create']);

    Route::post('updatePerfil',[ControladorPerfil::class,'update']);

    Route::post('esborraUsuari', [ControladorPerfil::class, 'delete']);

    Route::post('updateImatgePerfil',[ControladorPerfil::class, 'updateImatgePerfil']);

    Route::get('planificacio', [ControladorPlanificacio::class, 'create']);

    Route::post('planificacioUsuari',[ControladorPlanificacio::class, 'storePlanificacio']);

    Route::get('cercador', [ControladorBuscador::class, 'create']);

    Route::get('cercador/cerca_aliments',[ControladorBuscador::class, 'createCercador']);

    Route::get('cercador/afegeix_aliment',[ControladorBuscador::class, 'createAfegir']);

    Route::post('addAliment',[ControladorBuscador::class, 'storeAfegir']);

    Route::get('cercador/aliments_propis',[ControladorBuscador::class, 'createPropis']);

    Route::get('cercador/aliments_propis/{nom}',[ControladorAliment::class, 'create']);

    Route::post('esborraAliment',[ControladorAliment::class,'delete']);

    Route::post('updateAliment',[ControladorAliment::class, 'update']);

    Route::get('cercador/cerca_aliments',[ControladorBuscador::class, 'createBuscador']);

    Route::post('cercaAliment',[ControladorBuscador::class, 'getAliments']);

    Route::get('calendari',[ControladorCalendari::class,'create']);

    Route::get('calendari/{data}',[ControladorDieta::class,'create']);

    Route::post('afegeixAlimentDieta',[ControladorDieta::class,'afegeixAlimentDieta']);

    Route::post('esborraDia',[ControladorDieta::class, 'deleteDia']);

    Route::post('esborraAlimentApat',[ControladorDieta::class, 'deleteAlimentApat']);

    Route::post('randomApat',[ControladorDieta::class, 'getRandomApat']);

    Route::get('progres',[ControladorProgres::class, 'create']);

    Route::post("addPesAltura",[ControladorProgres::class, 'store']);

    Route::get("llistes_compra",[ControladorLlistesCompra::class, 'create']);

    Route::get("llistes_compra/modifica_llista/{nom}",[ControladorLlistesCompra::class, 'modificaView']);

    Route::get("llistes_compra/crea_llista",[ControladorLlistesCompra::class, 'creaView']);

    Route::post("createUpdateList", [ControladorLlistesCompra::class, 'afegirOUpdate']);

    Route::post("esborraLlista",[ControladorLlistesCompra::class, 'deleteLlista']);

});

Route::middleware(['guest'])->group(function () {
    Route::get('registre', [ControladorRegistre::class, 'create']);

    Route::post('registre', [ControladorRegistre::class, 'store']);

    Route::get('login', [ControladorLogin::class, 'create'])->name('login');

    Route::post('login', [ControladorLogin::class, 'store']);

    Route::get('recuperacio', [ControladorResetPassword::class, 'createFormContra'])->name('forget.password.get');

    Route::post('recuperacio', [ControladorResetPassword::class, 'submitFormContra'])->name('forget.password.post');

    Route::get('reinicia-contrasenya/{token}', [ControladorResetPassword::class, 'createReiniciaContra'])->name('reset.password.get');

    Route::post('reinicia-contrasenya', [ControladorResetPassword::class, 'submitReiniciaContra'])->name('reset.password.post');
});



