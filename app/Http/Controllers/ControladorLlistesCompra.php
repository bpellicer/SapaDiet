<?php

namespace App\Http\Controllers;

use App\Models\LlistaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ControladorLlistesCompra extends Controller
{
    /**
     * Funció que retorna la vista de llistesCompra amb totes les llistes de la compra de l'Usuari
     */
    public function create(){
        $title = "Sapa Diet | Llistes de la Compra";
        $llistes = LlistaCompra::all()->where("user_id",Auth::id());
        return view("pages.llistesCompra",[
            "llistesCompra"     => $llistes
        ],compact("title"));
    }

    /**
     * Funció que retorna la vista de creaLlista amb l'acció d'afegir i dos variables auxiliars perquè el formulari serveixi
     * tant com per afegir llistes com per modificar-les.
     */
    public function creaView(){
        $title = "Sapa Diet | Crea una Llista";
        return view("pages.creaLlista",[
            "accio"             => "afegir",
            "arrayContingut"    => [0],
            "llista"            => ""
        ],compact("title"));
    }

    /**
     * Funció que retorna la vista de creaLlista, però amb paràmetres de la modificació
     * @param String $nom       Conté el nom de la llista
     */
    public function modificaView($nom){
        $title = "Sapa Diet | Modifica la Llista";
        $llista = LlistaCompra::where("user_id",Auth::id())->where("titol",$nom)->first();
        if(!$llista){
            return view("errors.404");
        }

        /** Obté totes les llistes de la compra **/
        $arrayllistesCompra = Storage::disk('public')->exists('llistesCompra.json') ? json_decode(Storage::disk('public')->get('llistesCompra.json')) : [];

        /** Obté la llista que coincideix amb el nom **/
        $llistaJson = $this->getLlista($arrayllistesCompra,$nom);

        /** Array que conté el contingut de la llista, explode amb asterisc, ja que el contingut es guarda
         *  d'aquesta manera = 1*Peix*2*Plats*15*Plats... **/
        $arrayContingut = [];
        $arrayContingut = explode("*",$llistaJson->contingut);

        return view("pages.creaLlista",[
            "accio"             => "modificar",
            "llista"            => $llista,
            "arrayContingut"    => $arrayContingut
        ],compact("title"));
    }

    /**
     * Funció que retorna la llista de la compra de l'array $arrayLlistes
     * @param Array $arrayLlistes       Conté les llistes de la compra
     * @param String $titol             Conté el nom de la llista
     */
    public function getLlista($arrayLlistes,$titol){
        foreach($arrayLlistes as $llista){
            if($llista->user_id == Auth::id() && $llista->titol === $titol) return $llista;
        }
    }


    /**
     * Funció que comprova l'acció del request per a realitzar una modificació o una inserció d'una llista de la compra
     * @param Request $request  Conté tota la informació de la Llista de la Compra
     */
    public function afegirOUpdate(Request $request){
        $request->validate([
            "titol"                     =>  ['required','string','regex:/^[A-zÀ-ú ]*$/','max:30'],
            "quantitatsProducte.*"      =>  ['required','numeric','min:1','max:999'],
            "nomsProducte.*"            =>  ['required','string','regex:/[A-zÀ-ú ]*$/','max:30'],
            "estil"                    =>   ['required','string','regex:/banana|loto|classic|ploma/'],
            "accio"                     =>  ['required','string','regex:/[A-zÀ-ú ]*$/','min:6','max:9'],
        ]);


        /** Si l'acció no coincideix amb cap d'aquestes, redirect back amb un missatge d'error **/
        if($request->accio != "modificar" && $request->accio != "afegir"){
            session()->flash("errorAccio","Acció errònia!");
            return redirect()->back();
        }

        /** Els Strings a la BDD tenen una llargada màxima de 190 caràcters fent servir ClearDB, així que he de guardar la informació de les
         *  llistes a un altre lloc. Per això, faré servir un fitxer JSON que contindrà l'User_ID, el títol de la llista i el contingut d'aquesta.
         *  Lo altre ho guardaré a la BDD.
         */

        $contingut = $this->getContingut($request->quantitatsProducte,$request->nomsProducte);
        /** Array amb la informació de la llista pel fitxer JSON **/
        $dades = [
            "user_id"   => Auth::id(),
            "titol"     => $request->titol,
            "contingut" => $contingut
        ];

        /** Obté l'array del fitxer JSON, altrament array buit **/
        $arrayLlistesCompra = Storage::disk('public')->exists('llistesCompra.json') ? json_decode(Storage::disk('public')->get('llistesCompra.json')) : [];

        if($request->accio == "afegir"){
            $llistaCompra = new LlistaCompra();
            session()->flash("llistaCreada","Llista creada!");
        }
        else if($request->accio == "modificar"){
            /** Si es vol modificar i no troba la llista a la BDD, redirect back amb missatge d'error **/
            if(!LlistaCompra::where("id",$request->idLlista)->where("user_id",Auth::id())->first()){
                session()->flash("errorLlista","Llista no existent");
                return redirect()->back();
            }
            /** Comptador **/
            $i = 0;

            foreach($arrayLlistesCompra as $llistaCompraArray){
                /** Si coincideix, esborra la llista de l'Array **/
                if($llistaCompraArray->user_id == Auth::id() && $llistaCompraArray->titol == $dades["titol"]){
                    unset($arrayLlistesCompra[$i]);
                }
                $i++;
            }

            /** Obté els valors de la llista ordenats **/
            $arrayLlistesCompra = array_values($arrayLlistesCompra);

            /** Obté la llista de la BDD **/
            $llistaCompra = LlistaCompra::where("id",$request->idLlista)->first();
            session()->flash("llistaModificada","Llista modificada!");
        }

        /** Afegeix la nova llista a l'array de llistes i ho guarda al fitxer JSON **/
        array_push($arrayLlistesCompra,$dades);
        Storage::disk('public')->put('llistesCompra.json', json_encode($arrayLlistesCompra));

        /** Actualitza o insereix els camps de la Llista de la Compra a la BDD **/
        $llistaCompra->titol = $request->titol;
        $llistaCompra->classe = $request->estil;
        $llistaCompra->user_id = Auth::id();
        $llistaCompra->save();

        return redirect("/llistes_compra");
    }

    /**
     * Funció que retorna el contingut de les arrays en un sol string.
     * @param Array $arrayQ     Conté les quantitats de cada producte
     * @param Array $arrayN     Conté els noms de cada producte
     */
    public function getContingut($arrayQ, $arrayN){
        $string = "";

        for($i = 0; $i < count($arrayQ); $i++){
            $string .= $arrayQ[$i]."*".$arrayN[$i];
            if($i < count($arrayQ) - 1) $string.="*";
        }

        return $string;
    }

    /**
     * Funció que esborra una Llista de la BDD i del fitxer JSON
     * @param Request $request      Conté el nom de la Llista de la Compra
     */
    public function deleteLlista(Request $request){
        $request->validate([
            "nom"   => ["required","string","regex:/^[A-zÀ-ú ]*$/",'max:30',Rule::exists("llistes_compra","titol")]
        ]);
        /** Localitza la llista a la BDD **/
        $llista =  LlistaCompra::where("user_id",Auth::id())->where("titol",$request->nom)->first();

        /** Si no existeix, redirect back amb un missatge d'error **/
        if(!$llista){
            session()->flash("errorEsborrar","Llista no existent");
            return redirect()->back();
        }
        /** Obtenim les llistes del fitxer JSON **/
        $arrayLlistesCompra = Storage::disk('public')->exists('llistesCompra.json') ? json_decode(Storage::disk('public')->get('llistesCompra.json')) : [];
        /** Comptador **/
        $i = 0;
        foreach($arrayLlistesCompra as $llistaCompraArray){
            /**  Si la troba, fa un unset dins l'array **/
            if($llistaCompraArray->user_id == Auth::id() && $llistaCompraArray->titol == $request->nom){
                unset($arrayLlistesCompra[$i]);
            }
            $i++;
        }

        /** Retorna tots els valors ordenats de l'Array de les Llistes de la compra **/
        $arrayLlistesCompra = array_values($arrayLlistesCompra);

        /** Guarda el nou array dins el fitxer JSON **/
        Storage::disk('public')->put('llistesCompra.json', json_encode($arrayLlistesCompra));

        /** Esborra la llista de la BDD **/
        $llista->delete();

        session()->flash("llistaEsborrada","Llista esborrada!");
        return redirect()->back();
    }
}
