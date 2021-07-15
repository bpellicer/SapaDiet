<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPlanificacio extends Controller
{
    public function create(){
        return view("pages.planificacio");
    }

    public function storePlanificacio(Request $request){
        if ($request->get("proteina") == null || $request->get("hidrats") == null ||
            $request->get("grasses") == null  || $request->get("lactics") == null ||
            $request->get("fruites") == null){
                return view("pages.planificacio");
        }
        ddd($request);
    }
}
