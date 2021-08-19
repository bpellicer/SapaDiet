<?php

namespace App\Http\Controllers;

use App\Models\AlimentPropi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ControladorAliment extends Controller
{
    /**
     * Funció que retorna la informació d'un AlimentPropi de l'Usuari de la Sessió
     * @param String $nom   Conté el nom de la pàgina
     */
    public function create($nom){
        $title = 'Sapa Diet | Informació '.$nom;
        $alimentPropi = AlimentPropi::where("nom","=",$nom)->where('user_id','=',Auth::id())->get();
        if($alimentPropi->count() == 0){
            return view("errors.404");
        }
        return view('pages.informacioAliment',[
            "aliment" => $alimentPropi
        ], compact('title'));
    }

    /**
     * Funció que esborra un Aliment Propi de la llista d'aliments de l'Usuari
     * @param Request $request  Conté el Id de l'Aliment a esborrar
     */
    public function delete(Request $request){
        $aliment = AlimentPropi::findOrFail($request->get("alimentId"));
        $aliment->delete();
        session()->flash('alimentEsborrat','Aliment esborrat!');
        return redirect("/cercador/aliments_propis");
    }

    /**
     * Funció que valida les dades del $request per després actualitzar les dades d'un Aliment Propi i redirigir a la plana d'aliments propis de l'Usuari
     * @param Request $request  Conté les dades del formulari
     */
    public function update(Request $request){
        $atributs = $request->validate([
            'kilocalories' => ['required','numeric','max:1000','min:0'],
            'proteines' => ['required','numeric', 'max:1000', 'min:0'],
            'hidrats' => ['required','numeric', 'max:1000', 'min:0'],
            'greixos' => ['required','numeric', 'max:1000', 'min:0']
        ]);
        $alimentPropi = AlimentPropi::find($request->get("id"));
        $this->updateDadesAliment($atributs,$alimentPropi);
        session()->flash('alimentActualitzat','Aliment actualitzat!');
        return redirect("/cercador/aliments_propis");

    }

    /**
     *  Funció que actualitza els valors de l'Aliment Propi de l'Usuari amb els $atributs del formulari
     * @param array $atributs   Array d'atributs de l'aliment
     * @param AlimentPropi      Objecte de la classe AlimentPropi
     */
    public function updateDadesAliment($atributs, $alimentPropi){

        $alimentPropi->proteines = $atributs["proteines"];
        $alimentPropi->hidrats = $atributs["hidrats"];
        $alimentPropi->greixos = $atributs["greixos"];
        $alimentPropi->kilocalories = $atributs["kilocalories"];

        $alimentPropi->save();
    }
}
