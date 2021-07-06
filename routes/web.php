<?php

use App\Http\Controllers\ControladorRegistre;
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

Route::get('login', function () {
    return view('pages.login');
});

Route::get('registre', function () {
    return view('pages.registre');
});

Route::post('registre', [ControladorRegistre::class, 'store']);

Route::get('Gestió Dieta', function () {
    return view('pages.gestioDieta');
});
