<?php

namespace App\Http\Controllers;

use App\Models\LlistaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorLlistesCompra extends Controller
{
    public function create(){
        $title = "Sapa Diet | Llistes de la Compra";
        $llistes = LlistaCompra::all()->where("user_id",Auth::id());
        return view("pages.llistesCompra",[
            "llistesCompra"     => $llistes
        ],compact("title"));
    }

    public function creaView(){
        $title = "Sapa Diet | Crea una Llista";
        return view("pages.creaLlista",[
            "accio" => "afegir"
        ],compact("title"));
    }

    public function modificaView($nom){
        $title = "Sapa Diet | Modifica la Llista";
        return view("pages.creaLlista",[
            "accio" => "modificar"
        ],compact("title"));
    }

    public function afegirOUpdate(Request $request){
        $request->validate([
            "titol"                    =>  ['required','string','regex:/^[A-zÀ-ú ]*$/','max:30'],
            "quantitatsProducte.*"       =>  ['required','numeric','min:1','max:999'],
            "nomsProducte.*"             =>  ['required','string','regex:/[A-zÀ-ú ]*$/','max:30'],
            "accio"                    =>  ['required','string','regex:/[A-zÀ-ú ]*$/','min:6','max:6']
        ]);

        ddd($request);
        if($request->accio != "modificar" && $request->accio != "afegir"){
            session()->flash("errorAccio","Acció errònia!");
            return redirect()->back();
        }

        ddd($request);
    }
}
