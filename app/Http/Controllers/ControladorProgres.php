<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorProgres extends Controller
{
    public function create(){
        $title = "SapaDiet | Progrés";
        return view("pages.progres",[

        ],compact("title"));
    }
}
