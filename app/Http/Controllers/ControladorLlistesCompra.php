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

    public function store(){
        $title = "Sapa Diet | Crea una Llista";
        return view("pages.creaLlista",compact("title"));
    }
}
