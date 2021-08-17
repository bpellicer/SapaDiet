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
        $pesAltura = PesAltura::where("user_id",Auth::id())->orderBy("data","DESC")->first();

        $imc = $this->getImc($pesAltura->pes,$pesAltura->altura);

        return view("pages.progres",[
            "pes"       => $pesAltura->pes,
            "altura"    => $pesAltura->altura,
            "imc"       => $imc
        ],compact("title"));
    }

    public function getImc($pes, $altura){
        if($pes == 0 && $altura == 0) return 0;
        else return round($pes / (($altura/100) * ($altura/100)),2);
    }

    public function store(Request $request){
        $request->validate([
            "pes"       => ['required', 'numeric', 'min:0'],
            "altura"    => ['required', 'numeric', 'min:0']
        ]);

        $pesAltura = PesAltura::where("user_id",Auth::id())->orderBy("data","DESC")->first();

        if($pesAltura->data != "20".date("y")."-".date("m")."-".date("d")){
            $pesAltura = new PesAltura();
            $pesAltura->user_id = Auth::id();
            $pesAltura->data = "20".date("y")."-".date("m")."-".date("d");
        }

        $pesAltura->pes = $request->get("pes");
        $pesAltura->altura = $request->get("altura");

        $pesAltura->save();

        session()->flash("pesAlturaUpdate","Informació guardada!");

        return redirect("/progres");
    }
}
