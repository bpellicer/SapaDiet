<?php

namespace App\Http\Controllers;

use App\Models\PesAltura;
use App\Models\User;
use App\Models\UserApat;
use App\Models\UserApatAliment;
use App\Models\UserApatAlimentPropi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorProgres extends Controller
{
    public function create(){
        $title = "SapaDiet | Progrés";
        $usuari = User::findOrFail(Auth::id());
        $pesAltura = PesAltura::where("user_id",Auth::id())->orderBy("data","DESC")->first();

        $imc = $this->getImc($pesAltura->pes,$pesAltura->altura);
        $arrayPesos = PesAltura::where('user_id',Auth::id())->orderBy("data","DESC")->limit(7)->get();

        $arrayUserApats = UserApat::where("user_id",Auth::id())->get();

        $arrayAlimentsApatDia = [];

        /**  Bucle que recorre l'array dels àpats de l'Usuari **/
        foreach($arrayUserApats as $apat){
            /** Guarda els aliments de l'àpat de l'Usuari en una arrayAliments filtrant per la data **/
            $arrayAliments = [];

            /** Filtra els aliments per la data i els afegeix a l'array d'Aliments **/
            foreach($apat->aliment as $aliment){
                if($aliment->pivot->data == "2021-08-19"){
                    array_push($arrayAliments,$aliment);
                }
            }
            /** Filtra els aliments propis per la data i els afegeix a l'Array d'Aliments **/
            foreach($apat->alimentPropi as $alimentPropi){
                if($alimentPropi->pivot->data == "2021-08-19"){
                    array_push($arrayAliments,$alimentPropi);
                }
            }
            array_push($arrayAlimentsApatDia,array_values($arrayAliments));
        }

        ddd($arrayAlimentsApatDia);

        return view("pages.progres",[
            "pes"       => $pesAltura->pes,
            "altura"    => $pesAltura->altura,
            "imc"       => $imc,
            'pesos'     => $arrayPesos
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
