<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'nom'       => ['required','max:30','string','alpha'],
            'cognoms'   => ['required','max:255','string','regex:/[A-zÀ-ú ]*$/'],
            'sexe'      => ['required','string','alpha'],
            'edat'      => ['required','min:12','max:100','numeric']
        ]);

        /** Busca l'usuari per Id **/
        $usuariId = Auth::id();
        $usuari = User::findOrFail($usuariId);


        /** Si les dades no han canviat, redirect al perfil**/
        if($usuari->nom == $request->get('nom') && $usuari->cognoms == $request->get('cognoms')
            && $usuari->sexe == $request->get("sexe") && $usuari->sexe == $request->get('edat')){

            session()->flash('perfilError','Canvia algún valor!');
            return redirect("/perfil");
        }

        /** Comprova que el camp Sexe sigui Home o Dona i si no és cap, torna enrere **/
        if($request->sexe != "Home" && $request->sexe != "Dona"){
            session()->flash("errorSexe","Escull un Sexe de la llista!");
            return redirect()->back()->withInput();
        }

        /** Altrament, canvia els valors de l'usuari i redirigeix al perfil amb un missatge **/
        $usuari->nom = $request->get('nom');
        $usuari->cognoms = $request->get('cognoms');
        $usuari->sexe = $request->get('sexe');
        $usuari->edat = $request->get('edat');

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

        /** Esborra l'Usuari **/
        $usuari->delete();

        /** Esborra la Planificació (S'esborra després perquè l'id de la planificació està a la taula users i perquè tots els Usuaris tenen la
         *  mateixa planificació per defecte. Si l'user_id estigués a la taula de planificacions amb un onDelete(cascade), l'Usuari podría
         *  esborrar la planificació per defecte) **/
        $usuari->deletePlanificacio();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->flash('perfilEsborrat','Dades esborrades!');

        return redirect("/");
    }

    /**
     * Funció que actualitza la imatge de perfil de l'Usuari
     * @param Request $request  Conté la nova imatge de perfil de l'Usuari
     */
    public function updateImatgePerfil(Request $request){
        $request->validate([
            "imatge"    => ['numeric','min:1','max:12']
        ]);

        $usuari = User::findOrFail(Auth::id());
        $usuari->imatge_id = $request->get("imatge");
        $usuari->save();

        session()->flash('imatgeNova','Imatge guardada!');

        return redirect("/perfil");
    }
}
