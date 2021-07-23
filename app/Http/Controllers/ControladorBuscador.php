<?php

namespace App\Http\Controllers;

use App\Models\AlimentPropi;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $alimentPropi = new AlimentPropi();
        $alimentPropi->nom = $atributs['nom'];
        $alimentPropi->proteines = $atributs['proteines'];
        $alimentPropi->hidrats =  $atributs['hidrats'];
        $alimentPropi->grasses =  $atributs['grasses'];
        $alimentPropi->kilocalories = $atributs['kcal'];
        $alimentPropi->categoria_id =  Categoria::where('nom','=',$atributs['categoria'])->firstOrFail()->id;
        $alimentPropi->imatge_id =  1;
        $alimentPropi->usuari_id = User::findOrFail(Auth::id())->id;

        $alimentPropi->save();

        session()->flash('alimentCreat','Aliment creat correctament');

        return redirect("/cercador");
    }

    public function createPropis(){
        $title = "Sapa Diet | Els Teus Aliments";
    }
}
