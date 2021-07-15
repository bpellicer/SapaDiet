<?php

namespace App\Http\Controllers;

use App\Models\Planificacio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControladorPlanificacio extends Controller
{
    public function create(){
        $usuariId = Auth::id();
        $usuari = User::findOrFail($usuariId);
        $planificacio = Planificacio::findOrFail($usuari->planificacio_id);
        $aliments = DB::table('planificacions')
                    ->select('aliments_preferits.nom')
                    ->join('aliment_preferit_planificacio','planificacions.id','=','aliment_preferit_planificacio.planificacio_id')
                    ->join('aliments_preferits', 'aliments_preferits.id','=','aliment_preferit_planificacio.aliment_preferit_id')
                    ->get();

        return view("pages.planificacio",[
            'planificacio'=> $planificacio,
            'aliments' => $aliments->pluck('nom')->toArray()
        ]);
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
