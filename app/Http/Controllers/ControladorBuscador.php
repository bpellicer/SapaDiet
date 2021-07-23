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

    public function storeAfegir(Request $request){
        $atributs = $request->validate([
            'nom' => ['required','string','alpha','max:100'],
            'kcal' => ['required','numeric','min:0'],
            'proteines' => ['required','numeric', 'max:1000', 'min:0'],
            'hidrats' => ['required','numeric', 'max:1000', 'min:0'],
            'grasses' => ['required','numeric', 'max:1000', 'min:0'],
            'categoria' => ['required']
        ]);

        ddd($request);
    }

    public function createPropis(){
        $title = "Sapa Diet | Els Teus Aliments";
    }
}
