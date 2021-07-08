<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ControladorPerfil extends Controller
{
    public function create(){
        return view('pages.perfil');
    }


    public function update(Request $request){

        /** Busca l'usuari per Id **/
        $usuariId = Auth::id();
        $usuari = User::findOrFail($usuariId);

        /** Validem les dades del request **/
        $request->validate([
            'nom'=>['required','max:30','string'],
            'cognoms'=>['required','max:255','string']
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
}
