<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class ControladorBuscador extends Controller
{
    public function create(){
        $title = "Sapa Diet | Cerca";
        return view("pages.cerca", compact("title"));
    }

    public function createCercador(){

    }

    public function createAfegir(){
        $title = "Sapa Diet | Crea Aliment";
        return view("pages.afegeixAliment",[
            'categories' => Categoria::all()
        ],compact("title"));
    }

    public function createPropis(){
        $title = "Sapa Diet | Els Teus Aliments";
    }
}
