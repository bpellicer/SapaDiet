<?php

namespace App\Http\Controllers;

use App\Models\PesAltura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorCalendari extends Controller
{
    public function create(){
        $usuari = User::findOrFail(Auth::id());

        /* Controla que l'Usuari només pugui entrar al calendari si ha guardat la planificació */
        if($usuari->planificacio_id == 1){
            session()->flash("planificacioDefecte","Guarda la planificació primer!");
            return redirect("/planificacio");
        }
         /** Controla que l'Usuari només pugui entrar una vegada ha afegit el seu pes i la seva altura **/
        else if(PesAltura::where("user_id",$usuari->id)->get()->last()->pes == 0 && PesAltura::where("user_id",$usuari->id)->get()->last()->altura == 0){
            session()->flash("pesAlturaError","Falta altura i pes");
            return redirect("/progres");
        }
        else{
            $title = "Sapa Diet | Calendari";

            $diesMes = date('t');
            $dia = date('d');
            $mes = date('m');
            $any = date('y');
            $mesNom = $this->getMes($mes);

            return view("pages.calendari",[
                "dies" => $diesMes,
                "any" => $any,
                "dia" => $dia,
                "mesNom" => $mesNom,
                "mes" => $mes
            ], compact("title"));
        }

    }

    public function getMes($mes){
        $nomMes = "";
        switch ($mes){
            case 1:
                $nomMes = "Gener";
            break;
            case 2:
                $nomMes = "Febrer";
            break;
            case 3:
                $nomMes = "Març";
            break;
            case 4:
                $nomMes = "Abril";
            break;
            case 5:
                $nomMes = "Maig";
            break;
            case 6:
                $nomMes = "Juny";
            break;
            case 7:
                $nomMes = "Juliol";
            break;
            case 8:
                $nomMes = "Agost";
            break;
            case 9:
                $nomMes = "Setembre";
            break;
            case 10:
                $nomMes = "Octubre";
            break;
            case 11:
                $nomMes = "Novembre";
            break;
            case 12:
                $nomMes = "Desembre";
            break;
        }
        return $nomMes;
    }
}

