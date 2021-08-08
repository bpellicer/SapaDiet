<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorDieta extends Controller
{
    public function create($data){
        $title = "Sapa Diet | ";

        if( $this->abans("-", $data) < 10 ){
            $title = $title."0".$data;
        }
        else{
            $title = "Sapa Diet | $data";
        }

        return view("pages.dieta",[

        ],compact("title"));
    }

    public function abans ($a, $string)
    {
        return substr($string, 0, strpos($string, $a));
    }
}
