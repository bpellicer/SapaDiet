<?php

namespace App\Http\Controllers;

use App\Models\Planificacio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorPlanificacio extends Controller
{
    public function create(){
        $usuariId = Auth::id();
        $usuari = User::findOrFail($usuariId);
        $planificacio = Planificacio::findOrFail($usuari->planificacio_id);
        $aliments = $planificacio->alimentpreferit;
        return view("pages.planificacio",[
            'planificacio'=> $planificacio,
            'aliments' => $aliments->pluck('id')->toArray()
        ]);
    }

    public function storePlanificacio(Request $request){
        /* Comprova que cap array estigui buida */
        if ($request->get("proteines") == null || $request->get("hidrats") == null ||
            $request->get("grasses") == null  || $request->get("lactics") == null ||
            $request->get("fruites") == null){
                session()->flash('formulariInvalid','Mínim 1 aliment per categoria');
                return redirect()->back();
        }

        /* Busca l'usuari */
        $usuari = User::findOrFail(Auth::id());

        /* Guarda els aliments del request en una array */
        $aliments = $this->getAliments($request);

        /* Si la planificació de l'Usuari és la estàndar, crea una nova planificació */
        if($usuari->planificacio->id == 1){
            $planificacio = new Planificacio;
            $planificacio->nombre_apats = $request->get("apat");
            $planificacio->objectius = $request->get("objectius");
            $planificacio->save();
            $planificacio->alimentpreferit()->attach($aliments);    //Afegeix tots els aliments triats del formulari a la taula pivot N:M aliment_preferit_planificacio
            $usuari->planificacio_id = $planificacio->id;           //Actualitza el camp Id de la planificació de l'Usuari
            $usuari->save();
        }
        /* Modifica la planificació de l'Usuari i els seus aliments */
        else{
            $planificacio = Planificacio::findOrFail($usuari->planificacio_id);
            $planificacio->nombre_apats = $request->get("apat");
            $planificacio->objectius = $request->get("objectius");
            $planificacio->save();
            $planificacio->alimentpreferit()->detach();             //Esborra tots els camps de la taula pivot
            $planificacio->alimentpreferit()->attach($aliments);    //Insereix els nous camps a la taula pivot
        }

        return redirect("/planificacio");
    }

    public function getAliments(Request $request){
        $aliments = array_merge($request->get("proteines"), $request->get("hidrats"));
        $aliments = array_merge($aliments,$request->get("grasses"));
        $aliments = array_merge($aliments,$request->get("lactics"));
        $aliments = array_merge($aliments,$request->get("fruites"));
        return $aliments;
    }
}
