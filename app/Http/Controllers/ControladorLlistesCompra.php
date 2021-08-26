<?php

namespace App\Http\Controllers;

use App\Models\LlistaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ControladorLlistesCompra extends Controller
{
    public function create(){
        $title = "Sapa Diet | Llistes de la Compra";
        $llistes = LlistaCompra::all()->where("user_id",Auth::id());
        return view("pages.llistesCompra",[
            "llistesCompra"     => $llistes
        ],compact("title"));
    }

    public function creaView(){
        $title = "Sapa Diet | Crea una Llista";
        return view("pages.creaLlista",[
            "accio" => "afegir",
            "llista" => [0]
        ],compact("title"));
    }

    public function modificaView($nom){
        $title = "Sapa Diet | Modifica la Llista";
        $llista = LlistaCompra::where("user_id",Auth::id())->where("titol",$nom)->first();
        if(!$llista){
            session()->flash("errorLlista","Llista no existent");
            return redirect()->back();
        }

        $arrayllistesCompra = Storage::disk('public')->exists('llistesCompra.json') ? json_decode(Storage::disk('public')->get('llistesCompra.json')) : [];
        $llistaJson = $this->getLlista($arrayllistesCompra,$nom);

        $arrayContingut = [];

        $arrayContingut = explode("*",$llistaJson->contingut);

        return view("pages.creaLlista",[
            "accio"             => "modificar",
            "llista"            => $llista,
            "arrayContingut"    => $arrayContingut
        ],compact("title"));
    }

    public function getLlista($arrayLlistes,$titol){
        foreach($arrayLlistes as $llista){
            if($llista->user_id == Auth::id() && $llista->titol === $titol) return $llista;
        }
    }

    public function afegirOUpdate(Request $request){

        $request->validate([
            "titol"                     =>  ['required','string','regex:/^[A-zÀ-ú ]*$/','max:30'],
            "quantitatsProducte.*"      =>  ['required','numeric','min:1','max:999'],
            "nomsProducte.*"            =>  ['required','string','regex:/[A-zÀ-ú ]*$/','max:30'],
            "estil"                    =>   ['required','string','regex:/banana|loto|classic|ploma/'],
            "accio"                     =>  ['required','string','regex:/[A-zÀ-ú ]*$/','min:6','max:9'],
        ]);



        if($request->accio != "modificar" && $request->accio != "afegir"){
            session()->flash("errorAccio","Acció errònia!");
            return redirect()->back();
        }

        /** Els Strings a la BDD tenen una llargada màxima de 190 caràcters fent servir ClearDB, així que he de guardar la informació de les
         *  llistes a un altre lloc. Per això, faré servir un fitxer JSON que contindrà l'User_ID, el títol de la llista i el contingut d'aquesta.
         *  Lo demés ho guardaré a la BDD.
         */

        $contingut = $this->getContingut($request->quantitatsProducte,$request->nomsProducte);
        $dades = [
            "user_id"   => Auth::id(),
            "titol"     => $request->titol,
            "contingut" => $contingut
        ];
        $contactInfo = Storage::disk('public')->exists('llistesCompra.json') ? json_decode(Storage::disk('public')->get('llistesCompra.json')) : [];

        if($request->accio == "afegir"){
            $llistaCompra = new LlistaCompra();
            session()->flash("llistaCreada","Llista creada!");
        }
        else if($request->accio == "modificar"){
            if(!LlistaCompra::where("id",$request->idLlista)->where("user_id",Auth::id())->first()){
                session()->flash("errorLlista","Llista no existent");
                return redirect()->back();
            }
            $i = 0;
            foreach($contactInfo as $llistaCompraArray){
                if($llistaCompraArray->user_id == Auth::id() && $llistaCompraArray->titol == $dades["titol"]){
                    unset($contactInfo[$i]);
                }
                $i++;
            }
            $contactInfo = array_values($contactInfo);
            Storage::disk('public')->put('llistesCompra.json', json_encode($contactInfo));

            $llistaCompra = LlistaCompra::where("id",$request->idLlista)->first();
            session()->flash("llistaModificada","Llista modificada!");
        }

        array_push($contactInfo,$dades);
        Storage::disk('public')->put('llistesCompra.json', json_encode($contactInfo));
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
}
