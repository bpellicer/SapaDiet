<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPlanificacio extends Controller
{
    public function create(){
        return view("pages.planificacio");
    }
}
