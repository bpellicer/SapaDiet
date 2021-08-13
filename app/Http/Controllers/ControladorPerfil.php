<?php

namespace App\Http\Controllers;

use App\Models\AlimentPropi;
use App\Models\Imatge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorPerfil extends Controller
{
    /**
     * Funció que retorna la vista del perfil de l'Usuari i envía totes les imatges amb el tipus 'Perfil' a un div amagat.
     */
    public function create(){
        $title = "Sapa Diet | Perfil";
        return view('pages.perfil',[
            'imatges' => Imatge::where('tipus','=','perfil')->get(),
        ],compact("title"));
    }

    /**
     * Funció que actualitza les dades de l'Usuari. L'email és únic i per tant no es pot canviar. Si vols un nou email, has de fer-te un nou usuari.
     * @param Request $request  Conté el nou nom i cognoms de l'Usuari
     */
    public function update(Request $request){

        /** Busca l'usuari per Id **/
        $usuariId = Auth::id();
        $usuari = User::findOrFail($usuariId);

        /** Validem les dades del request **/
        $request->validate([
            'nom'=>['required','max:30','string','alpha'],
            'cognoms' =>['required','max:255','string','regex:/[A-zÀ-ú ]*$/']
        ]);

        /** Si les dades no han canviat, redirect al perfil**/
        if($usuari->nom == $request->get('nom') && $usuari->cognoms == $request->get('cognoms')){
            session()->flash('perfilError','Canvia algún valor!');
            return redirect("/perfil");
        }

        /** Altrament, canvia els valors de l'usuari i redirigeix al perfil amb un missatge **/
        $usuari->nom = $request->get('nom');
        $usuari->cognoms = $request->get('cognoms');

        $usuari->save();

        session()->flash('perfilActualitzat','Dades actualitzades!');

        return redirect("/perfil");

    }

    /**
     * Funció que esborra totes les dades relacionades amb l'Usuari
     */
    public function delete(Request $request){
        $usuariId = Auth::id();
        $usuari = User::findOrFail($usuariId);

        /** Esborra tots els AlimentsPropis de l'Usuari **/
        $alimentsPropis = AlimentPropi::all()->where("user_id","=",$usuari->id);
        foreach($alimentsPropis as $aliment){
            $aliment->delete();
        }

        /** Esborra l'Usuari i la seva Planificaicó **/
        $usuari->delete();
        $usuari->deletePlanificacio();

        session()->flash('perfilEsborrat','Dades esborrades!');

        return redirect("/");
    }

    /**
     * Funció que actualitza la imatge de perfil de l'Usuari
     * @param Request $request  Conté la nova imatge de perfil de l'Usuari
     */
    public function updateImatgePerfil(Request $request){
        $usuari = User::findOrFail(Auth::id());
        $usuari->imatge_id = $request->get("imatge");
        $usuari->save();

        session()->flash('imatgeNova','Imatge guardada!');

        return redirect("/perfil");
    }
}
