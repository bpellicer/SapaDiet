<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorCalendari extends Controller
{
    public function create(){
        $title = "Sapa Diet | Calendari";

        $diesMes = date('t');
        $actual = date('d-m-y');

        return view("pages.calendari",[
            "dies" => $diesMes,
            "actual" => $actual
        ], compact("title"));
    }
}
