<?php

namespace App\Http\Controllers;

use App\Models\PesAltura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorProgres extends Controller
{
    public function create(){
        $title = "SapaDiet | Progrés";
        $usuari = User::findOrFail(Auth::id());
        $pesAltura = PesAltura::where("user_id",Auth::id())->get()->toArray();
        $imc = $this->getImc($pesAltura[0]["pes"],$pesAltura[0]["altura"]);
        return view("pages.progres",[
            "pes"       => $pesAltura[0]["pes"],
            "altura"    => $pesAltura[0]["altura"],
            "imc"       => $imc
        ],compact("title"));
    }

    public function getImc($pes, $altura){
        if($pes == 0 && $altura == 0) return 0;
        else return $pes / (($altura * $altura)/100);
    }
}
