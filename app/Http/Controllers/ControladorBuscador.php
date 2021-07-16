<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorBuscador extends Controller
{
    public function create(){
        return view("pages.cerca");
    }
}
