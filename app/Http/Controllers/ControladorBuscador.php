<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class ControladorBuscador extends Controller
{
    public function create(){
        return view("pages.cerca");
    }

    public function createCercador(){

    }

    public function createAfegir(){
        return view("pages.afegeixAliment",[
            'categories' => Categoria::all()
        ]);
    }

    public function createPropis(){

    }
}
