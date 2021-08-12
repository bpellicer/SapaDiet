<?php

namespace App\Http\Controllers;

use App\Models\Apat;
use App\Models\Planificacio;
use App\Models\User;
use App\Models\UserApat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorPlanificacio extends Controller
{
    /**
     * Funció que retorna la vista de la planificació de l'Usuari, una array d'aliments (Id's) de la planificació i la Planificació en si.
     */
    public function create(){
        $title = "Sapa Diet | Planificació";
        $usuariId = Auth::id();
        $usuari = User::findOrFail($usuariId);
        $planificacio = Planificacio::findOrFail($usuari->planificacio_id);
        $aliments = $planificacio->alimentpreferit;
        return view("pages.planificacio",[
            'planificacio'=> $planificacio,
            'aliments' => $aliments->pluck('id')->toArray()
        ],compact("title"));
    }

    /**
     * Funció que guarda la planificació de l'Usuari
     * @param Request $request  Conté totes les dades per a la Planificació de l'Usuari
     */
    public function storePlanificacio(Request $request){
        /* Comprova que cap array estigui buida */
        if ($request->get("proteines") == null || $request->get("hidrats") == null ||
            $request->get("greixos") == null  || $request->get("lactics") == null ||
            $request->get("fruites") == null){
                session()->flash('formulariInvalid','Mínim 1 aliment per categoria');
                return redirect()->back();
        }

        /* Busca l'usuari */
        $usuari = User::findOrFail(Auth::id());
        $usuari->primera_vegada = false;


       /*  $apat = UserApat::where("user_id",Auth::id())->get();
        ddd($apat[0]->aliment[0]->pivot->data); */

        /* Guarda els aliments del request en una array */
        $aliments = $this->getAliments($request);

        /* Guarda els àpats de l'Usuari */
        $this->updateApats($request->get("apat"));

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

        session()->flash('novaPlanificacio','Planificació guardada!');

        return redirect("/planificacio");
    }

    /**
     * Funció que retorna una array d'aliments
     * @param Request $request  Conté els aliments que l'Usuari ha triat al formulari
     */
    public function getAliments(Request $request){
        $aliments = array_merge($request->get("proteines"), $request->get("hidrats"));
        $aliments = array_merge($aliments,$request->get("greixos"));
        $aliments = array_merge($aliments,$request->get("lactics"));
        $aliments = array_merge($aliments,$request->get("fruites"));
        return $aliments;
    }

    public function updateApats($nombreApats){
        $userApats = UserApat::where("user_id",Auth::id())->get();
        foreach($userApats as $element){
            $element->delete();
        }
        $apats = [];
        switch($nombreApats){
            case 2:
                $apats = [3,5];
            break;
            case 3:
                $apats = [1, 3, 5];
            break;
            case 4:
                $apats = [1,3,4,5];
            break;
            case 5:
                $apats = [1,2,3,4,5];
            break;
        }

        for($i = 0; $i < $nombreApats; $i++){
            $userApat = new UserApat();
            $userApat->user_id = Auth::id();
            $userApat->apat_id = $apats[$i];
            $userApat->save();
        }
    }
}
