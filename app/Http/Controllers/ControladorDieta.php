<?php

namespace App\Http\Controllers;

use App\Models\Aliment;
use App\Models\AlimentPropi;
use App\Models\Apat;
use App\Models\Categoria;
use App\Models\PesAltura;
use App\Models\Planificacio;
use App\Models\User;
use App\Models\UserApat;
use App\Models\UserApatAliment;
use App\Models\UserApatAlimentPropi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            session()->flash('dataIncorrecte','Data Incorrecta!');
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
            $planificacio = $usuari->planificacio;

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
                $arrayAliments = [];

                /** Filtra els aliments per la data i els afegeix a l'array d'Aliments **/
                foreach($apat->aliment as $aliment){
                    if($aliment->pivot->data == $this->giraData($dataAvui)){
                        array_push($arrayAliments,$aliment);
                    }
                }
                /** Filtra els aliments propis per la data i els afegeix a l'Array d'Aliments **/
               foreach($apat->alimentPropi as $alimentPropi){
                   if($alimentPropi->pivot->data == $this->giraData($dataAvui)){
                       array_push($arrayAliments,$alimentPropi);
                   }
               }

                $arrayImatgesApat = [];
                /** Bucle per afegir les imatges de cada aliment a l' $arrayImatges **/
                foreach($arrayAliments as $aliment){
                    array_push($arrayImatgesApat, $aliment->categoria->imatge->url);
                }

                array_push($arrayImatges,$arrayImatgesApat);
                array_push($arrayAlimentsApatDia,array_values($arrayAliments));
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
        if(count($array) != 3       || !checkdate($array[1],$array[0],intval($any)) ||
            date("m") != $mes       ||  strlen($array[0]) > 2                       ||
            strlen($array[1]) > 2   ||  strlen($array[2]) > 2                       ){

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

    /**
     * Funció que retorna les kilocalories que ha de consumir l'Usuari segons els seus desitjos
     * @param User $usuari                  Conté un objecte de la classe l'Usuari
     * @param Planificacio $planificació    Conté un objecte de la classe Planificació
     */
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
            'grams'     => ['numeric','required', 'min:0', 'max:9999'],
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
                /** Busca a la classe pivot UserApatAlimentPropi si existeix l'aliment afegit a l'apat i a la data corresponent **/
                $alimentPropiUserApat = UserApatAlimentPropi::where('user_apat_id',$userApat->id)->where("data",$request->data)->where("aliment_propi_id",$request->alimentId)->first();
                /** Si existeix, actualitza els grams de l'aliment **/
                if($alimentPropiUserApat){
                    $alimentPropiUserApat->mesura_quantitat += $request->grams;
                }
                /** Altrament, crea un nou Aliment dins de l'Àpat de l'Usuari **/
                else{
                    $alimentPropiUserApat = new UserApatAlimentPropi();
                    $alimentPropiUserApat->user_apat_id = $userApat->id;
                    $alimentPropiUserApat->data = $request->data;
                    $alimentPropiUserApat->mesura_quantitat = $request->grams;
                    $alimentPropiUserApat->aliment_propi_id = $request->alimentId;
                }
                $alimentPropiUserApat->save();
                session()->flash("alimentAfegit","Aliment afegit!");
                return redirect("/cercador/aliments_propis");
            }
            else return view("errors.404");
        }
        else if($request->tipusAliment == "bdd"){
            /** Comprova que l'Aliment existeixi a la BDD **/
            if(Aliment::where("id",$request->alimentId)->first()){
                /** Busca a la classe pivot UserApatAliment si existeix l'aliment afegit a l'apat i a la data corresponent **/
                $alimentUserApat = UserApatAliment::where('user_apat_id',$userApat->id)->where('data',$request->data)->where("aliment_id",$request->alimentId)->first();

                /** Si existeix, actualitza els grams de l'aliment **/
                if($alimentUserApat){
                    $alimentUserApat->mesura_quantitat += $request->grams;
                }

                /** Altrament, crea un nou Aliment dins de l'Àpat de l'Usuari **/
                else{
                    $alimentUserApat = new UserApatAliment();
                    $alimentUserApat->user_apat_id = $userApat->id;
                    $alimentUserApat->data = $request->data;
                    $alimentUserApat->mesura_quantitat = $request->grams;
                    $alimentUserApat->aliment_id = $request->alimentId;
                }

                $alimentUserApat->save();
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
        $request->validate([
            'data'    => ['string','required','date_format:d-m-Y','date']
        ]);
        /** Format de la data en YYYY-MM-DD **/
        $data = $this->giraData($request->data);

        /** Obté els Àpats de l'Usuari **/
        $userApats = UserApat::where("user_id",Auth::id())->get();
        $arrayExtra = [];

        /** Bucle que guarda a una array auxiliar $arrayExtra els aliments que es troben als àpats de l'Usuari i que coincideixin amb la data del dia **/
        foreach($userApats as $apat){

            array_push($arrayExtra,UserApatAliment::where('user_apat_id',$apat->id)
                            ->where('data',$data)->get());
            array_push($arrayExtra,UserApatAlimentPropi::where('user_apat_id',$apat->id)
                            ->where('data',$data)->get());
        }

        /** Bucle que recorre l'array auxiliar $arrayExtra i esborra els aliments que hi apareixen **/
        foreach($arrayExtra as $apat){
            foreach($apat as $aliment){
                $aliment->delete();
            }

        }

        session()->flash("diaEsborrat","Dia esborrat!");
        return redirect("/calendari");
    }
    /**
     * Funció que esborra un Aliment de l'Àpat escollit.
     * @param Request $request      Conté les dades per a poder esborrar un Aliment d'un Àpat correctament
     */
    public function deleteAlimentApat(Request $request){
        $request->validate([
            'grams'         => ['string','required','min:1','max:9999'],
            'idAliment'     => ['required','string'],
            'data'          => ['required','string','date'],
            'apat'          => [Rule::exists('apats','nom'),'required','string']
        ]);

        /** Gira la data en format YYYY-MM-DD per a buscar-la a la BDD **/
        $data = $this->giraData($request->data);

        /** Obté l'Àpat de l'Usuari escollit **/
        $userApat = UserApat::where('user_id',Auth::id())->where("apat_id",Apat::where("nom",$request->apat)->first()->id)->first();

        /** Busca a la taula users_apats_aliments el registre que coincideixi amb l'Àpat de l'Usuari, la data, l'aliment id i la mesura_quantitat **/
        $alimentUserApat = UserApatAliment::where('user_apat_id',$userApat->id)
                            ->where('data',$data)->where("aliment_id",$request->idAliment)
                            ->where("mesura_quantitat",$request->grams)->first();

        /** Busca a la taula users_apats_aliments_propis el registre que coincideixi amb l'Àpat de l'Usuari, la data, l'aliment id i la mesura_quantitat **/
        $alimentPropiUserApat = UserApatAlimentPropi::where('user_apat_id',$userApat->id)
                                ->where("data",$data)->where("aliment_propi_id",$request->idAliment)
                                ->where("mesura_quantitat",$request->grams)->first();

        /** Formateja la data al format DD-MM-YY per a enviar-la per url a la ruta del calendari **/
        $formatData = substr($request->data, 0,6).substr($request->data, 8, strpos($request->data, "-"));

        /** Si troba l'Aliment a l'Àpat de l'Usuari, l'esborra **/
        if($alimentUserApat){
            $alimentUserApat->delete();
            session()->flash("alimentEsborrat","Aliment esborrat!");
            return redirect("/calendari/".$formatData);
        }
        /** Si troba l'AlimentPropi a l'Àpat de l'Usuari, l'esborra **/
        else if($alimentPropiUserApat){
            $alimentPropiUserApat->delete();
            session()->flash("alimentEsborrat","Aliment esborrat!");
            return redirect("/calendari/".$formatData);
        }
        /** Si els dos són NULL, redirigeix a la pàgina de 404 **/
        else{
            return view("errors.404");
        }
    }

    /**
     * Funció que afegeix una sèrie d'aliments aleatoris a la data i àpat escollit de l'Usuari, els quals
     * estan condicionats pels Aliments Preferits que tries a la Planificació.
     */
    public function getRandomApat(Request $request){
        $request->validate([
            'data'          => ['string','required','date_format:d-m-Y','date','required'],
            'apat'          => ['string',Rule::exists('apats','nom'),'required'],
            'kcalTotals'    => ['required','min:0','max:4000','numeric'],
            'nombreApats'   => ['required','min:2','max:5','numeric']
        ]);

        $usuari = User::findOrFail(Auth::id());
        $arrayAlimentsPreferits = $usuari->planificacio->alimentpreferit;

        $userApat = UserApat::where("user_id",Auth::id())->where("apat_id",Apat::where("nom",$request->apat)->first()->id)->first();
        $data = $this->giraData($request->data);

        /** Esborra els aliments que hi ha a l'Àpat a la data seleccionada **/
        $arrayAlimentsABorrar = UserApatAliment::where("user_apat_id",$userApat->id)->where("data",$data)->get();
        foreach($arrayAlimentsABorrar as $aliment){
            $aliment->delete();
        }

        /** Calculem quantes proteïnes, hidrats i greixos necessita l'Usuari per cada àpat
         *  Els divisors 4 i 9 provenen de les kcal per gram de nutrient. En 1 gram de proteïna hi ha 4 kcal. **/
        $proteines = round($request->kcalTotals * 0.25 / 4);
        $hidrats = round($request->kcalTotals * 0.5 / 4);
        $greixos = round($request->kcalTotals * 0.25 / 9);

        /** Depenent de l'Àpat que l'Usuari vulgui generar i del nombre d'àpats del dia,
         *  es necessitaran més o menys kcal, igual amb la resta de nutrients **/

        $arrayKcalNutriApat = $this->getKcalNutrientsOptims($request->nombreApats,$request->kcalTotals,$request->apat,$proteines,$hidrats,$greixos);

        /** Per a fer els Àpats més còmodes, a cada un d'aquests es posarà 1 Aliment de cada categoria (Proteïnes, Hidrats, Greixos, Begudes...) **/

        $arrayAliments = $this->getArrayAliments($arrayAlimentsPreferits);

        $this->generaApat($arrayAliments,$userApat,$data,$arrayKcalNutriApat);


        $formatData = substr($request->data, 0,6).substr($request->data, 8, strpos($request->data, "-"));

        session()->flash("apatAleatori","Àpat generat!");
        return redirect("/calendari/".$formatData);

    }

    /**
     * Acció (Void) que s'encarrega de generar els aliments aleatoris amb les mesures corresponents.
     * @param Array $arrayAliments          Conté l'array dels 5 aliments triats
     * @param UserApat $userApat            Conté l'Àpat de l'Usuari
     * @param Date $data                    Conté la data del dia
     * @param Array $arrayKcalNutriApat     Conté els nutrients que s'han de complir
     */
    public function generaApat($arrayAliments,$userApat,$data,$arrayKcalNutriApat){
        /** Array auxiliar per facilitar la feina a la funció de getMesuraCorrecte  **/
        $arrayTipusAliment = ["p","h","g","l","f"];
        for($i = 0 ; $i < count($arrayAliments); $i++){
            $userApatAliment = new UserApatAliment();
            $userApatAliment->aliment_id = $arrayAliments[$i]["id"];
            $userApatAliment->user_apat_id = $userApat->id;
            $userApatAliment->data = $data;
            $userApatAliment->mesura_quantitat = $this->getMesuraCorrecte($arrayAliments[$i],$arrayKcalNutriApat,$arrayTipusAliment[$i]);
            $userApatAliment->save();
        }
    }

    /**
     * Funció que retorna els grams necessaris per a cobrir les kilocalories per tipus d'Aliment suficients.
     * @param Aliment $aliment              Conté l'Aliment
     * @param Array $arrayKcalNutriApat     Conté l'Array dels nutrients
     * @param String $tipusAliment          Conté el tipus d'aliment
     */
    public function getMesuraCorrecte($aliment, $arrayKcalNutriApat,$tipusAliment){
        /** Segons el tipus d'Aliment, es multiplica les kcal per un porcentatge.
         *  La generació de la dieta no serà perfecta, però normalment un Àpat equilibrat conté entre
         *  20-40 gr de proteïna, 50-80 d'hidrats i 10-20 de greixos.
         *  Així que les proteïnes i els hidrats els he multiplicat per un 150-160% mentre que els
         *  làctics i greixos els he multiplicat per un 40-50% **/
        $kcalPerAliment = $arrayKcalNutriApat[0] / 5;
        $gramsXAliment = 0;
        switch ($tipusAliment){
            case "p":
                $gramsXAliment =  100 * $kcalPerAliment * 1.6 / $aliment->kilocalories;
            break;
            case "h":
                $gramsXAliment = 100 * $kcalPerAliment * 1.5 / $aliment->kilocalories;
            break;
            case "g":
                $gramsXAliment =  100 * $kcalPerAliment * 0.4 / $aliment->kilocalories;
            break;
            case "l":
                $gramsXAliment =  100 * $kcalPerAliment * 0.5 / $aliment->kilocalories;
            break;
            case "f":
                $gramsXAliment =  100 * $kcalPerAliment / $aliment->kilocalories;
            break;
        }
        return round($gramsXAliment);
    }

    /**
     * Funció que retorna una array de 5 aliments: 1 aliment de cada tipus de categoria essencial (proteïnes, hidrats, greixos, làctics i fruites).
     * @param Object $arrayAlimentsPreferits     Conté una array (Collection) amb tots els AlimentsPreferits de l'Usuari
     */
    public function getArrayAliments($arrayAlimentsPreferits){
        /** [proteïnes, hidrats, greixos, lactics, fruites] **/
        $arrAliments = [0,0,0,0,0];

        /** Obté 5 aliments aleatoris preferits, 1 de cada categoria **/
        $aProte = $arrayAlimentsPreferits->where('tipus','proteines')->random()->nom;
        $aHidra = $arrayAlimentsPreferits->where('tipus','hidrats')->random()->nom;
        $aGreix = $arrayAlimentsPreferits->where('tipus','greixos')->random()->nom;
        $aLactic = $arrayAlimentsPreferits->where('tipus','lactics')->random()->nom;
        $aFruita = $arrayAlimentsPreferits->where('tipus','fruites')->random()->nom;

        /** Hi ha algun aliment preferit que engloba tota una sèrie d'aliments com la Carn o el Peix. Quan això passa, busca l'aliment per la categoria
         *  o exclusivament pel seu nom **/

        /** Filtra els Aliments segons el nom dels 5 Aliments Preferits i agafa un aliment aleatori de tots els possibles **/
        if($aProte == "Carn" || $aProte == "Peix"){
            $arrAliments[0] = (Aliment::where("categoria_id",Categoria::where("value",strtolower($aProte))->first()->id)->get()->random());
        }
        else{
            $arrAliments[0] = Aliment::where("nom","like",$aProte."%")->get()->random();
            $arrAliments[1] = Aliment::where("nom","like",$aHidra."%")->get()->random();
            $arrAliments[2] = Aliment::where("nom","like",$aGreix."%")->get()->random();
            $arrAliments[4] = Aliment::where("nom","like",$aFruita."%")->get()->random();
        }

        if($aLactic == "B.Soja"){
            $arrAliments[3] = Aliment::where("nom","Beguda de soja")->first();
        }
        else if($aLactic == "B.Coco"){
            $arrAliments[3] = Aliment::where("nom","Beguda de coco")->first();
        }
        else if($aLactic == "B.Ametlla"){
            $arrAliments[3] = Aliment::where("nom","Beguda d'ametlles")->first();
        }
        else{
            $arrAliments[3] = Aliment::where("nom","like",$aLactic."%")->get()->random();
        }

        return $arrAliments;
    }

    /**
     * Funció que retorna una array que conté les kcal, proteïnes, hidrats i greixos òptims per a cada àpat.
     * @param Int $nombreApats              Conté el nombre d'Àpats de l'Usuari
     * @param Float $kcalTotals             Conté el nombre de Kcal que ha de consumir l'Usuari
     * @param String $nomApat               Conté el nom de l'Àpat que l'Usuari ha triat
     * @param Float $proteines              Conté el nombre de proteïnes
     * @param Float $hidrats                Conté el nombre d'hidrats
     * @param Float $greixos                Conté el nombre de greixos
     * @return Array $arrayKcalNutriOptims
     */
    public function getKcalNutrientsOptims($nombreApats, $kcalTotals, $nomApat,$proteines,$hidrats,$greixos){
        /** Array de resultats [kcal, prot, hidr, greix] */
        $arrayKcalNutriOptims = [0,0,0,0];

        /** Auxiliars **/
        $kcalApat = $kcalTotals / $nombreApats;
        $pApat = $proteines / $nombreApats;
        $hApat = $hidrats  / $nombreApats;
        $gApat = $greixos / $nombreApats;

        /** Perquè una dieta sigui equilibrada, es poden dividir les kilocalories diàries de moltes maneres.
         *  En el meu cas, he decidit que l'Esmorzar, el Dinar i el Sopar han de tenir les mateixes kcal,
         *  mentre que el Berenar i el Mig Matí han de tenir menys kcal que els tres Àpats anteriors, ja que no són
         *  àpats tan essencials **/

        if($nombreApats == 2 || $nombreApats == 3){
            $arrayKcalNutriOptims[0] = $kcalApat;
            $arrayKcalNutriOptims[1] = $pApat;
            $arrayKcalNutriOptims[2] = $hApat;
            $arrayKcalNutriOptims[3] = $gApat;
        }
        /** En el cas de $nombreApats > 3, el Berenar i el Mig Matí tenen un 35% menys de kcal i de nutrients del Total de cada per Àpat **/
        else if($nombreApats == 4){
            if($nomApat == "Berenar"){
                $arrayKcalNutriOptims[0] = $kcalApat - ($kcalApat * 0.35);
                $arrayKcalNutriOptims[1] = $pApat - ($pApat * 0.35);
                $arrayKcalNutriOptims[2] = $hApat - ($hApat * 0.35);
                $arrayKcalNutriOptims[3] = $gApat - ($gApat * 0.35);
            }
            else{
                $arrayKcalNutriOptims[0] = ($kcalTotals - ($kcalApat - ($kcalApat * 0.35))) / ($nombreApats - 1) ;
                $arrayKcalNutriOptims[1] = ($proteines - ($pApat - ($pApat * 0.35))) / ($nombreApats - 1);
                $arrayKcalNutriOptims[2] = ($hidrats - ($hApat - ($hApat * 0.35))) / ($nombreApats - 1);
                $arrayKcalNutriOptims[3] = ($greixos - ($gApat - ($gApat * 0.35))) / ($nombreApats - 1);
            }
        }
        else{
            if($nomApat == "Berenar" || $nomApat == "Mig Matí"){
                $arrayKcalNutriOptims[0] = $kcalApat - ($kcalApat * 0.35);
                $arrayKcalNutriOptims[1] = $pApat - ($pApat * 0.35);
                $arrayKcalNutriOptims[2] = $hApat - ($hApat * 0.35);
                $arrayKcalNutriOptims[3] = $gApat - ($gApat * 0.35);
            }
            else{
                $arrayKcalNutriOptims[0] = ($kcalTotals - ($kcalApat - ($kcalApat * 0.35)) * 2) / ($nombreApats - 2) ;
                $arrayKcalNutriOptims[1] = ($proteines - ($pApat - ($pApat * 0.35)) * 2) / ($nombreApats - 2);
                $arrayKcalNutriOptims[2] = ($hidrats - ($hApat - ($hApat * 0.35)) * 2) / ($nombreApats - 2);
                $arrayKcalNutriOptims[3] = ($greixos - ($gApat - ($gApat * 0.35)) * 2) / ($nombreApats - 2);
            }
        }
        return $arrayKcalNutriOptims;
    }
}
