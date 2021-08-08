<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorCalendari extends Controller
{
    public function create(){
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

