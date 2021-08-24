<?php

namespace App\Http\Controllers;

use App\Models\PesAltura;
use App\Models\User;
use App\Models\UserApat;
use App\Models\UserApatAliment;
use App\Models\UserApatAlimentPropi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class ControladorProgres extends Controller
{
    /**
     * Funció que retorna
     */
    public function create(){
        $title = "SapaDiet | Progrés";
        $usuari = User::findOrFail(Auth::id());
        $pesAltura = PesAltura::where("user_id",Auth::id())->orderBy("data","DESC")->first();

        $imc = $this->getImc($pesAltura->pes,$pesAltura->altura);
        $arrayPesos = PesAltura::where('user_id',Auth::id())->orderBy("data","DESC")->limit(7)->get();

        $arrayUserApats = UserApat::where("user_id",Auth::id())->get();

        /** Obté els últims 7 dies des d'avui i els guarda en una array de dies **/
        $arrayDies = [];
        for($i = 0; $i < 7; $i++){
            array_push($arrayDies,date('Y-m-d', strtotime(-$i." day")));
        }

        $arrayKcal7Dies = $this->getKcalTotals7dies($arrayUserApats,$arrayDies);

        return view("pages.progres",[
            "pes"            => $pesAltura->pes,
            "altura"         => $pesAltura->altura,
            "imc"            => $imc,
            'pesos'          => $arrayPesos,
            'dies'           => $arrayDies,
            'arrayKcal7Dies' => $arrayKcal7Dies

        ],compact("title"));
    }

    public function getKcalTotals7dies($arrayUserApats,$arrayDies){
        $arrayKcalTotals = [];
        foreach($arrayDies as $dia){
            array_push($arrayKcalTotals,$this->getKcalDia($arrayUserApats,$dia));
        }
        return $arrayKcalTotals;
    }

    public function getKcalDia($arrayUserApats,$dia){
        /**  Bucle que recorre l'array dels àpats de l'Usuari **/
        $sumaKcalDia = 0;
        foreach($arrayUserApats as $apat){
            /** Bucle que per cada àpat, agafa un aliment i comprova si coincideix amb el dia que es passa per paràmetre **/
            foreach($apat->aliment as $aliment){
                if($aliment->pivot->data == $dia){
                    /** Si coincideix, es divideix la quantitat de l'aliment entre 100 (grams),es multiplica per les kilocalories i es suma a la variable
                     * $sumaKcalDia global **/
                    $sumaKcalDia += round($aliment->pivot->mesura_quantitat/100 * $aliment->kilocalories);
                }
            }
            /** Bucle que per cada àpat, agafa un aliment propi i comprova si coincideix amb el dia que es passa per paràmetre*/
            foreach($apat->alimentPropi as $alimentPropi){
                if($alimentPropi->pivot->data == $dia){
                    $sumaKcalDia += round($alimentPropi->pivot->mesura_quantitat/100 * $alimentPropi->kilocalories);
                }
            }
        }
        return $sumaKcalDia;
    }

    /**
     * Funció que retorna l'Índex de massa corporal.
     * @param Float $pes        Conté el pes de l'Usuari
     * @param Float $altura     Conté l'altura de l'Usuari
     */
    public function getImc($pes, $altura){
        if($altura==0 || $pes==0 ) return 0;
        else return round($pes / (($altura/100) * ($altura/100)),2);
    }

    /**
     * Funció que guarda un nou pes i altura a la BDD o, si el dia ja ha sigut omplert amb les dades, actualitza els valors.
     * @param Request $request     Conté el nou pes i altura de l'Usuari
     */
    public function store(Request $request){
        $request->validate([
            "pes"       => ['required', 'numeric', 'min:0', 'max:500'],
            "altura"    => ['required', 'numeric', 'min:0','max:250']
        ]);

        /** Busca l'últim registre del PesAltura a la BDD **/
        $pesAltura = PesAltura::where("user_id",Auth::id())->orderBy("data","DESC")->first();

        /**  Si la data no coincideix amb la d'avui, crea un nou Objecte PesAltura i hi assigna l'Id de l'Usuari i la data d'avui **/

        if($pesAltura->data != date("Y-m-d")){
            $pesAltura = new PesAltura();
            $pesAltura->user_id = Auth::id();
            $pesAltura->data = date("Y-m-d");
        }

        /** Coincideixi o no la data, actualitza el camp pes i altura **/
        $pesAltura->pes = $request->get("pes");
        $pesAltura->altura = $request->get("altura");

        $pesAltura->save();

        session()->flash("pesAlturaUpdate","Informació guardada!");

        return redirect("/progres");
    }
}
