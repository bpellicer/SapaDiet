<?php

namespace App\Http\Controllers;

use App\Models\AlimentPropi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ControladorAliment extends Controller
{
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

    public function delete(Request $request){
        $aliment = AlimentPropi::findOrFail($request->get("alimentId"));
        $aliment->delete();
        session()->flash('alimentEsborrat','Aliment esborrat!');
        return redirect("/cercador/aliments_propis");
    }

    public function update(Request $request){
        $atributs = $request->validate([
            'nom' => ['required','string','regex:/^[A-zÀ-ú ]*$/','max:20',Rule::unique('aliment_propis','nom')->where(
                function($query){
                    return $query->where('user_id',Auth::id());
                })
            ],
            'kilocalories' => ['required','numeric','min:0','max:1000'],
            'proteines' => ['required','numeric', 'max:1000', 'min:0'],
            'hidrats' => ['required','numeric', 'max:1000', 'min:0'],
            'grasses' => ['required','numeric', 'max:1000', 'min:0']
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

        $alimentPropi->nom = $atributs["nom"];
        $alimentPropi->proteines = $atributs["proteines"];
        $alimentPropi->hidrats = $atributs["hidrats"];
        $alimentPropi->grasses = $atributs["grasses"];
        $alimentPropi->kilocalories = $atributs["kilocalories"];

        $alimentPropi->save();
    }
}
