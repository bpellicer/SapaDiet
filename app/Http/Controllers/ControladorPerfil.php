<?php

namespace App\Http\Controllers;

use App\Models\AlimentPropi;
use App\Models\Imatge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorPerfil extends Controller
{
    public function create(){
        $title = "Sapa Diet | Perfil";
        return view('pages.perfil',[
            'imatges' => Imatge::where('tipus','=','perfil')->get(),
        ],compact("title"));
    }


    public function update(Request $request){

        /** Busca l'usuari per Id **/
        $usuariId = Auth::id();
        $usuari = User::findOrFail($usuariId);

        /** Validem les dades del request **/
        $request->validate([
            'nom'=>['required','max:30','string','alpha'],
            'cognoms'=>['required','max:255','string','alpha']
        ]);

        /** Si les dades no han canviat, redirect al perfil**/
        if($usuari->nom == $request->get('nom') && $usuari->cognoms == $request->get('cognoms')){
            return redirect("/perfil");
        }

        /** Altrament, canvia els valors de l'usuari i redirigeix al perfil amb un missatge **/
        $usuari->nom = $request->get('nom');
        $usuari->cognoms = $request->get('cognoms');

        $usuari->save();

        session()->flash('perfilActualitzat','Dades actualitzades correctament');

        return redirect("/perfil");

    }

    public function delete(Request $request){
        $usuariId = Auth::id();
        $usuari = User::findOrFail($usuariId);
        $alimentsPropis = AlimentPropi::all()->where("user_id","=",$usuari->id);
        foreach($alimentsPropis as $aliment){
            $aliment->delete();
        }
        $usuari->delete();
        $usuari->deletePlanificacio();

        session()->flash('perfilEsborrat','Dades esborrades correctament');

        return redirect("/");
    }

    public function updateImatgePerfil(Request $request){
        $usuari = User::findOrFail(Auth::id());
        $usuari->imatge_id = $request->get("imatge");
        $usuari->save();
        return redirect("/perfil");
    }
}
