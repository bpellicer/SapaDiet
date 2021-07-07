<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPerfil extends Controller
{
    public function create(){
        return view('pages.perfil');
    }
}
