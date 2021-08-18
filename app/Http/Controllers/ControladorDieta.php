<?php

namespace App\Http\Controllers;

use App\Models\Aliment;
use App\Models\AlimentPropi;
use App\Models\Apat;
use App\Models\PesAltura;
use App\Models\Planificacio;
use App\Models\User;
use App\Models\UserApat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\AssignOp\Plus;

class ControladorDieta extends Controller
{
    /**
     * Funció que retorna la vista del dia de la dieta que coincideix amb la data $data. Envía tot un seguit de dades a la vista
     * per a omplir els diferents camps dels àpats, dels nutrients i tota la informació relacionada.
     * @param String $data      String que conté la data del dia seleccionat pel calendari o per l'Url.
     */
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
        /** Controla que l'Usuari només pugui entrar una vegada ha afegit el seu pes i la seva altura **/
        else if(PesAltura::where("user_id",$usuari->id)->get()->last()->pes == 0 && PesAltura::where("user_id",$usuari->id)->get()->last()->altura == 0){
            session()->flash("pesAlturaError","Falta altura i pes");
            return redirect("/progres");
        }
        else{
            /** Busca la planificació de l'Usuari per a mostrar X seccions a la gestió de la dieta segons el nombre d'àpats **/
            $usuari = User::findOrFail(Auth::id());
            $planificacio = Planificacio::findOrFail($usuari->planificacio_id);

            /** Posa la data del dia seleccionat al títol amb el format DD-MM-YYYY **/
            $dataAvui = date("m")."-20".date("y");
            $dataAvui = strlen($this->getDia("-",$data)) < 2 ? $dataAvui = "0".$this->getDia("-",$data)."-".$dataAvui : $this->getDia("-",$data)."-".$dataAvui;
            $title = "Sapa Diet | $dataAvui";

            /** Rep els apats que té l'Usuari i els guarda en una array **/
            $arrayUserApats = UserApat::where('user_id',$usuari->id)->get();

            /** Crea una array que conté a cada posició una altra array amb els aliments de cada àpat que coincideixi amb la data del dia que s'ha seleccionat **/
            $arrayAlimentsApatDia = [];

            /** Array d'imatges **/
            $arrayImatges = [];


            /**  Bucle que recorre l'array dels àpats de l'Usuari **/
            foreach($arrayUserApats as $apat){
                /** Guarda els aliments de l'àpat de l'Usuari en una arrayAliments filtrant per la data **/
                $arrayAliments = $apat->aliment->filter(function($value,$key) use ($dataAvui){
                    return $value->pivot->data == $this->giraData($dataAvui);
                });

                /** Fa el mateix que el codi d'amunt però amb els aliments propis de l'Usuari **/
                $arrayAlimentsPropis = $apat->alimentPropi->filter(function($value,$key) use($dataAvui){
                    return $value->pivot->data == $this->giraData($dataAvui);
                });

                /** Fusiona les 2 Collections en una sola array **/
                $arrayAliments = $arrayAliments->toBase()->merge($arrayAlimentsPropis);

                $arrayImatgesApat = [];
                /** Bucle per afegir les imatges de cada aliment a l' $arrayImatges **/
                foreach($arrayAliments as $aliment){
                    array_push($arrayImatgesApat, $aliment->categoria->imatge->url);
                }
                array_push($arrayImatges,$arrayImatgesApat);
                array_push($arrayAlimentsApatDia,array_values($arrayAliments->toArray()));
            }

            /** Guarda la quantitat de nutrients de cada àpat **/
            $arrayNutrients = $this->getNutrientsCalculats($arrayAlimentsApatDia);

            /** Guarda els nutrients totals de tots els àpats **/
            $arrayNutrientsTotals = $this->getNutrientsTotals($arrayNutrients);

            /** Guarda les kcal que l'Usuari haurà d'intentar complir cada dia **/
            $kcalTotals = $this->getDietaCalculada($usuari,$planificacio);

            return view("pages.dieta",[
                "nombreApats"           => $planificacio->nombre_apats,
                "nomsApats"             => $this->getArrayApatsNoms($planificacio->nombre_apats),
                "data"                  => $dataAvui,
                "arrayAliments"         => $arrayAlimentsApatDia,
                "arrayNutrientsApat"    => $arrayNutrients,
                "arrayNutrientsTotals"  => $arrayNutrientsTotals,
                "arrayImatges"          => $arrayImatges,
                "kcalTotals"            => $kcalTotals
                ],compact("title"));
            }
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
        return $dataArray[2]."-".$dataArray[1]."-".$dataArray[0];
    }

    /**
     * Funció que calcula els nutrients de cada àpat del dia i els guarda en una $superArrayNutrientsApats.
     * @param Array $arrayApatsAliments     Conté una array d'àpats amb els seus aliments
     */
    public function getNutrientsCalculats($arrayApatsAliments){
        $superArrayNutrientsApats = [];
        for($i = 0; $i < count($arrayApatsAliments); $i++){

            /** $arrayNutrientsApat[0] => proteïnes | $arrayNutrientsApat[1] = hidrats
            *   $arrayNutrientsApat[2] => greixos   | $arrayNutrientsApat[3] => kilocalories */
            $arrayNutrientsApat = [0, 0, 0, 0];

            for($j = 0; $j < count($arrayApatsAliments[$i]); $j++){

                /** Cada nutrient de cada aliment es multiplica per la quantitat d'aquest aliment triat i dividit per 100 (Estàndard de 100 grams)
                *   El resultat s'arrodoneix a 2 decimals per a una millor comoditat visual **/
                $arrayNutrientsApat[0] += round($arrayApatsAliments[$i][$j]["proteines"] * ($arrayApatsAliments[$i][$j]["pivot"]["mesura_quantitat"] / 100));
                $arrayNutrientsApat[1] += round($arrayApatsAliments[$i][$j]["hidrats"] * ($arrayApatsAliments[$i][$j]["pivot"]["mesura_quantitat"] / 100));
                $arrayNutrientsApat[2] += round($arrayApatsAliments[$i][$j]["greixos"] * ($arrayApatsAliments[$i][$j]["pivot"]["mesura_quantitat"] / 100));
                $arrayNutrientsApat[3] += round($arrayApatsAliments[$i][$j]["kilocalories"] * ($arrayApatsAliments[$i][$j]["pivot"]["mesura_quantitat"] / 100));
            }
            array_push($superArrayNutrientsApats,$arrayNutrientsApat);
        }
        return $superArrayNutrientsApats;
    }

    /**
     * Funció que retorna una array de nutrients calculats totals del dia.
     * $arrayTotals[0] => proteïnes | $arrayTotals[1] = hidrats
     * $arrayTotals[2] => greixos   | $arrayTotals[3] => kilocalories
     * @param Array $arrayNutrients     Conté els nutrients de cada àpat del dia ja sumats
     */
    public function getNutrientsTotals($arrayNutrients){
        $arrayTotals = [0,0,0,0];
        for($i = 0; $i < count($arrayNutrients); $i++){
            for($j = 0; $j < count($arrayNutrients[$i]); $j++){
                $arrayTotals[$j] += $arrayNutrients[$i][$j];
            }
        }
        return $arrayTotals;
    }

    public function getDietaCalculada($usuari,$planificacio){
        $pesAltura = PesAltura::where("user_id",$usuari->id)->get()->last();
        $kcalTotals = 0;
        /** La primera part és calcular el Metabolisme Basal(La energia que es gasta cada dia de forma normal) **/

        /** Es fa servir la fòrmula de MIFFLIN-ST JEOR **/
        $metabolismeBasal = $this->getMetabolismeBasal($pesAltura, $usuari);

        /** Es calcula la TDEE (Total Daily Energy Expenditure) i es multiplica pel metabolisme basal **/
        $kcalTotals = $this->getKcalTdee($metabolismeBasal,$planificacio->esport);

        /** Es suma o resta unes kilocalories de més segons els objectius de l'Usuri **/
        $kcalTotals = $this->getKcalObjectiu($planificacio->objectius, $kcalTotals);

        return $kcalTotals;
    }

    /**
     * Funció que fa servir la fòrmula de MIFFLIN-ST JEOR per a calcular el
     * metabolisme basal diari d'una persona i el retorna.
     * @param PesAltura $pesAltura      Conté l'Objecte $pesAltura
     * @param User  $usuari             Conté l'Objecte $usuari
     */
    public function getMetabolismeBasal($pesAltura,$usuari){
        $metabolismeBasal = 0;
        switch ($usuari->sexe){
            case "Home":
                $metabolismeBasal = (10 * $pesAltura->pes) + (6.25 * $pesAltura->altura) - (5 * $usuari->edat) + 5;
            break;
            case "Dona":
                $metabolismeBasal = (10 * $pesAltura->pes) + (6.25 * $pesAltura->altura) - (5 * $usuari->edat) -161;
            break;
        }
        return $metabolismeBasal;
    }


    /**
     * Funció que retorna les kilocalories totals que l'Usuari ha de consumir segons els
     * seus objectius de pes.
     * @param String $objectius     Conté l'objectiu de pes de l'Usuari.
     * @param Float $kcalTotals     Conté les kcal totals fins el moment.
     */
    public function getKcalObjectiu($objectius, $kcalTotals){

        $kcal = 0;
        switch($objectius){
            case "perdre pes":
                /** Per perdre pes es necessita un dèficit calòric, és a dir, menjar menys
                 * kilocalories de les que se't recomanen per dia. Es recomana entre 300 i
                 * 500 menys**/

                $kcal = $kcalTotals - 400;
            break;

            case "mantenir pes":
                $kcal = $kcalTotals;
            break;

            case "guanyar pes":
                /** Per guanyar pes es necessita un superàvit calòric, és a dir, menjar més
                 * kilocalories de les que se't recomanen per dia. Es recomana entre 300 i
                 * 500 més**/

                $kcal = $kcalTotals + 400;
            break;
        }
        return round($kcal);
    }


    /**
     * Funció que retorna les kilocalories que ha de consumir l'Usuari segons l'esport que fa
     * a la setmana.
     * @param Float $mtb       Conté les kcal del metabolisme basal de l'Usuari
     * @param String $esport    Conté la quantitat d'esport que fa l'Usuari a la setmana
     */
    public function getKcalTdee($mtb, $esport){
        $kcal = 0;
        switch($esport){
            case "Cap":
                $kcal = 1.2 * $mtb;
            break;

            case "Poc":
                $kcal = 1.375 * $mtb;
            break;

            case "Normal":
                $kcal = 1.55 * $mtb;
            break;

            case "Molt":
                $kcal = 1.725 * $mtb;
            break;
        }
        return $kcal;
    }

    /**
     * Funció que afegeix a l'Àpat de l'Usuari triat, un Aliment amb la data del dia i la quantitat en grams d'aquest Aliment
     * @param Request $request      Conté les dades per a afegir un nou aliment.
     */
    public function afegeixAlimentDieta(Request $request){
        $request->validate([
            'data'      => ['date','required'],
            'grams'     => ['numeric','required', 'min:0', 'max:1000'],
            'apat'      => ['string',Rule::exists("apats","nom")]
        ]);

        /** Comprova que la data d'inserció de l'aliment sigui de l'any i mes actual **/
        $arrayData = explode("-",$request->data);
        if($arrayData[1] != date('m') || $arrayData[0] != "20".date("y")){
            session()->flash("errorData", "Només pots afegir aliments a l'any i mes actual!");
            return redirect()->back();
        }

        /** Comprova que l'aliment s'afegeixi a un àpat dels que disposa l'Usuari a la seva Planificació **/
        $planificacio = User::where("id",Auth::id())->first()->planificacio;
        if(!$this->comprovaApats($planificacio->nombre_apats,$request->apat)){
            session()->flash("errorApat", "No disposes d'aquest àpat!");
            return redirect()->back();
        }

        /**  Obté l'Àpat de l'Usuari que coincideix amb el nom de l'àpat del $request i amb l'id de l'Usuari **/
        $userApat = UserApat::where("apat_id",Apat::where("nom",$request->apat)->first()->id)->where("user_id",Auth::id())->first();

        if($request->tipusAliment == "propi"){
            /** Comprova que l'AlimentPropi existeixi a la BDD i que sigui de l'Usuari **/
            if(AlimentPropi::where("id",$request->alimentId)->where("user_id",Auth::id())->first()){
                /** Afegeix l'aliment a la taula pivot users_apats_aliments_propis amb la data, la mesura i els corresponents ids **/
                $userApat->alimentPropi()->attach([$userApat->id => ["aliment_propi_id" => $request->alimentId, "mesura_quantitat" => $request->grams, "data" => $request->data]]);
                session()->flash("alimentAfegit","Aliment afegit!");
                return redirect("/cercador/aliments_propis");
            }
            else return view("errors.404");
        }
        else if($request->tipusAliment == "bdd"){
            /** Comprova que l'Aliment existeixi a la BDD **/
            if(Aliment::where("id",$request->alimentId)->first()){
                /** Afegeix l'aliment a la taula pivot user_apats_aliments amb la data, la mesura i els corresponents ids **/
                $userApat->aliment()->attach([$userApat->id => ["aliment_id" => $request->alimentId, "mesura_quantitat" => $request->grams, "data" => $request->data]]);
                session()->flash("alimentAfegit","Aliment afegit!");
                return redirect("/cercador/cerca_aliments");
            }
            else return view("errors.404");

        }
        else return view("errors.404");

    }

    /**
     * Funció que recorre una $arrayApats de $nombreApats iteracions. Si troba el $nomApat,
     * retorna un booleà $trobat = true, altrament retorna false.
     * @param String $nombreApats   Conté el nombre d'àpats de la Planificació de l'Usuari.
     * @param String $nomApat       Conté el nom de l'àpat a on es vol afegir l'aliment.
     */
    public function comprovaApats($nombreApats, $nomApat){
        $arrayApats = ["Dinar","Sopar","Esmorzar","Berenar","Mig Matí"];
        $trobat = false;
        for($i = 0; $i < $nombreApats; $i++){
            if($arrayApats[$i] == $nomApat) $trobat = true;
        }
        return $trobat;
    }

    /**
     * Funció que esborra els aliments dels Àpats de l'Usuari
     * @param Request $request      Conté la data del dia a esborrar
     */
    public function deleteDia(Request $request){

        $data = $this->giraData($request->data);
        $userApats = UserApat::where("user_id",Auth::id())->get();
        for($i = 0; $i < count($userApats); $i++){
            for($j = 0; $j < count($userApats[$i]->aliment); $j++){
                if($userApats[$i]->aliment[$j]->pivot["data"] == $data){
                    $userApats[$i]->aliment[$j]->delete();
                }
            }
            for($k = 0; $k < count($userApats[$i]->alimentPropi); $k++){
                if($userApats[$i]->alimentPropi[$k]->pivot["data"] == $data){
                    $userApats[$i]->alimentPropi[$k]->delete();
                }
            }
        }

        session()->flash("diaEsborrat","Dia esborrat!");
        return redirect("/calendari");
    }

}
