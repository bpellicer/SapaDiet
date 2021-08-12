<?php

namespace App\Http\Controllers;

use App\Models\Apat;
use App\Models\Planificacio;
use App\Models\User;
use App\Models\UserApat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorDieta extends Controller
{
    public function create($data){
        $usuari = User::findOrFail(Auth::id());
        /** Controla que l'Usuari només pugui entrar al dia de la dieta si ha guardat la planificació **/
        if($usuari->planificacio_id == 1){
            session()->flash("planificacioDefecte","Guarda la planificació primer!");
            return redirect("/planificacio");
        }
        /** Controla que l'Usuari només pugui entrar a les dates del mes actual i l'any actual **/
        else if(!$this->comprovaData($data)){
            session()->flash('dataIncorrecte','Escull una data vàlida del mes i any actual');
            return redirect("/calendari");
        }

        /** Rep els apats que té l'Usuari i els guarda en una array **/
        $arrayUserApats = UserApat::where('user_id',$usuari->id)->get();

        /** Crea una array que conté a cada posició una altra array amb els aliments de cada àpat que coincideixi amb la data del dia que s'ha seleccionat **/
        $arrayAlimentsApatDia = [];
        foreach($arrayUserApats as $apat){
            $arrayAliments = $apat->aliment->filter(function($value,$key) use ($data){
                return $value->pivot->data == $this->giraData($data);
            });

            array_push($arrayAlimentsApatDia,array_values($arrayAliments->toArray()));
        }

        /** Busca la planificació de l'Usuari per a mostrar X seccions a la gestió de la dieta segons el nombre d'àpats **/
        $usuari = User::findOrFail(Auth::id());
        $planificacio = Planificacio::findOrFail($usuari->planificacio_id);

        /** Posa la data del dia seleccionat al títol amb el format DD-MM-YYYY **/
        $dataAvui = date("m")."-20".date("y");
        $dataAvui = strlen($this->getDia("-",$data)) < 2 ? $dataAvui = "0".$this->getDia("-",$data)."-".$dataAvui : $this->getDia("-",$data)."-".$dataAvui;
        $title = "Sapa Diet | $dataAvui";

        return view("pages.dieta",[
            "nombreApats"   => $planificacio->nombre_apats,
            "nomsApats"     => $this->getArrayApatsNoms($planificacio->nombre_apats),
            "data"          => $dataAvui,
            "arrayAliments" => $arrayAlimentsApatDia
        ],compact("title"));
    }

    /**
     * Funció que retorna el dia de la data seleccionada abans del String $string (" - ")
     * @param String $string    Conté l'String que serveix com a stop del mètode strpos
     * @param String $data      Conté la data seleccionada en format D-M-YY
     */
    public function getDia ($string, $data)
    {
        return substr($data, 0, strpos($data, $string));
    }

    /**
     * Funció que retorna un array de títols d'àpats per a les seccions de la vista
     * @param String $nombreApats   Conté el nombre d'àpats de la planificació de l'Usuari
     */
    public function getArrayApatsNoms($nombreApats){
        $array = [];
        switch ($nombreApats){
            case "2":
                $array = ["Dinar","Sopar"];
            break;
            case "3":
                $array = ["Esmorzar","Dinar","Sopar"];
            break;
            case "4":
                $array = ["Esmorzar","Dinar","Berenar","Sopar"];
            break;
            case "5":
                $array = ["Esmorzar","Mig Matí","Dinar","Berenar","Sopar"];
            break;
        }
        return $array;
    }

    /**
     * Funció que comprova que la data de l'URL sigui correcta segons els estàndards que he triat.
     * @param String $data      Conté la data que s'ha seleccionat
     */
    public function comprovaData($data){
        $dataCorrecte = true;
        /** Separa la data en una array **/
        $array = explode("-",$data);

        /** Assigna un valor mes i any (Si no compleix les condicions se l'assigna un valor default 00000000) **/
        $mes = $array[1] == date("m") || $array[1] == "0".date("m") ? date("m") : "00000000";
        $any = $array[2] == date("y") ? "20".date("y") : "00000000";

        /** If que comprova si la data és correcte, entre altres condicions. Si la data no compleix els requisits, el booleà dataCorrecte = false **/
        if(count($array) != 3 || !checkdate($array[1],$array[0],intval($any)) || date("m") != $mes || strlen($array[0]) > 2 ||  strlen($array[1]) > 2 ||  strlen($array[2]) > 2){
            $dataCorrecte = false;
        }
        return $dataCorrecte;
    }

    /**
     * Funció que retorna la data seleccionada per l'Usuari girada en format YYYY-MM-DD
     * @param String $data      Conté la data que s'ha seleccionat
     */
    public function giraData($data){
        $dataArray = explode("-",$data);
        return "20".$dataArray[2]."-".$dataArray[1]."-".$dataArray[0];
    }

    /**
     * Funció que afegeix a l'Àpat de l'Usuari triat, un Aliment amb la data del dia i la quantitat en grams d'aquest Aliment
     * @param Request $request      Conté les dades per a afegir un nou aliment
     */
    public function afegeixAlimentDieta(Request $request){
        ddd("aaa");
        /* $userApat[0]->aliment()->attach($userApat[0]->id,["mesura_quantitat" => "90","aliment_id" => "180","data" => "2021-08-13"]); */
    }
}
