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
        $planificacio =  $usuari->planificacio;
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
                session()->flash('formulariInvalid','Mínim 1 aliment per grup');
                return redirect()->back();
        }

        /* Busca l'usuari */
        $usuari = User::findOrFail(Auth::id());
        $usuari->primera_vegada = false;

        /* Guarda els aliments del request en una array */
        $aliments = $this->getAliments($request);

        /* Si la planificació de l'Usuari és la estàndar, crea una nova planificació */
        if($usuari->planificacio->id == 1){
            $planificacio = new Planificacio;
            $planificacio->nombre_apats = $request->get("apat");
            $planificacio->objectius = $request->get("objectius");
            $planificacio->esport = $request->get("esport");
            $planificacio->save();
            $planificacio->alimentpreferit()->attach($aliments);    //Afegeix tots els aliments triats del formulari a la taula pivot N:M aliment_preferit_planificacio
            $usuari->planificacio_id = $planificacio->id;           //Actualitza el camp Id de la planificació de l'Usuari
            $usuari->save();

            /* Guarda els àpats de l'Usuari */
            $this->updateApats($request->get("apat"));
        }
        /* Modifica la planificació de l'Usuari i els seus aliments */
        else{
            $planificacio = Planificacio::findOrFail($usuari->planificacio_id);
            $planificacio->nombre_apats = $request->get("apat");
            $planificacio->objectius = $request->get("objectius");
            $planificacio->esport = $request->get("esport");
            $planificacio->save();
            $planificacio->alimentpreferit()->detach();             //Esborra tots els camps de la taula pivot
            $planificacio->alimentpreferit()->attach($aliments);    //Insereix els nous camps a la taula pivot

            /* Guarda els àpats de l'Usuari */
            if ($planificacio->nombre_apats != $request->get("apat"))$this->updateApats($request->get("apat"));
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

    /**
     * Funció que actualitza els Àpats de l'Usuari. En aquest cas, no contemplo guardar els aliments
     * que hi ha a cada àpat si el nombre d'aquests canvia. En un futur ho faré, però hauria de
     * contemplar masses coses com per fer-ho ara mateix.
     * @param String $nombreApats   Conté el nombre d'àpats de la planificació de l'Usuari.
     */
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
