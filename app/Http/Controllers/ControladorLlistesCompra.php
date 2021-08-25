<?php

namespace App\Http\Controllers;

use App\Models\LlistaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorLlistesCompra extends Controller
{
    public function create(){
        $title = "Sapa Diet | LListes de la Compra";
        $llistes = LlistaCompra::all()->where("user_id",Auth::id());
        return view("pages.llistesCompra",[
            "llistesCompra"     => $llistes
        ],compact("title"));
    }
}
