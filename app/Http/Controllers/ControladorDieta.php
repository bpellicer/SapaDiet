<?php

namespace App\Http\Controllers;

use App\Models\Planificacio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorDieta extends Controller
{
    public function create($data){
        if(!$this->comprovaData($data)){
            session()->flash('dataIncorrecte','Escull una data vàlida del mes i any actual');
            return redirect("/calendari");
        }

        $usuari = User::findOrFail(Auth::id());
        $planificacio = Planificacio::findOrFail($usuari->planificacio_id);
        $dataAvui = date("m")."-20".date("y");
        $dataAvui = strlen($this->getDia("-",$data)) < 2 ? $dataAvui = "0".$this->getDia("-",$data)."-".$dataAvui : $this->getDia("-",$data)."-".$dataAvui;
        $title = "Sapa Diet | $dataAvui";


        return view("pages.dieta",[
            "nombreApats"   => $planificacio->nombre_apats,
            "nomsApats"     => $this->getArrayApatsNoms($planificacio->nombre_apats),
            "data"          => $dataAvui
        ],compact("title"));
    }

    public function getDia ($string, $data)
    {
        return substr($data, 0, strpos($data, $string));
    }

    public function getArrayApatsNoms($nombreApats){
        $array = [];
        switch ($nombreApats){
            case "2":
                $array = ["Dinar","Sopar"];
            break;
            case "3":
                $array = ["Esmorzar","Dinar","Sopar"];
            break;
            case "4":
                $array = ["Esmorzar","Dinar","Berenar","Sopar"];
            break;
            case "5":
                $array = ["Esmorzar","Mig Matí","Dinar","Berenar","Sopar"];
            break;
        }
        return $array;
    }

    public function comprovaData($data){
        $dataCorrecte = true;
        $array = explode("-",$data);
        $mes = $array[1] == date("m") || $array[1] == "0".date("m") ? date("m") : "00000000";
        $any = $array[2] == date("y") ? "20".date("y") : "00000000";
        if(count($array) != 3 || !checkdate($array[1],$array[0],intval($any)) || date("m") != $mes || strlen($array[0]) > 2 ||  strlen($array[1]) > 2 ||  strlen($array[2]) > 2){
            $dataCorrecte = false;
        }
        return $dataCorrecte;
    }

    public function afegeixAlimentDieta(Request $request){
        ddd("aaa");
    }
}
