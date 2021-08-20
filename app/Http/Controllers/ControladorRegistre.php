<?php

namespace App\Http\Controllers;

use App\Models\PesAltura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ControladorRegistre extends Controller
{
    /**
     * Funció que retorna la vista de la pàgina de registre
     */
    public function create(){
        $title = "Sapa Diet | Registre";
        return view('pages.registre',compact("title"));
    }

    /**
     * Funció que crea un Usuari amb els valors validats del $request
     * @param Request $request  Conté els valors per a la creació d'un nou Usuari
     */
    public function store(Request $request){
        $atributs = $request->validate([
            'nom'                   => ['required','max:30','alpha'],
            'cognoms'               => ['required','max:255','string','regex:/[A-zÀ-ú ]*$/'],
            'email'                 => ['required','max:255','email',Rule::unique('users','email')],
            'contrasenya'           => ['required','max:255','same:password_confirmation',Password::min(8)->mixedCase()->symbols()],
            'sexe'                  => ['required','string','alpha'],
            'password_confirmation' => ['required','min:8','max:255'],
            'edat'                  => ['required','min:12','max:100','numeric']
        ]);

        /** Comprova que el camp Sexe sigui Home o Dona i si no és cap, torna enrere **/
        if($request->sexe != "Home" && $request->sexe != "Dona"){
            session()->flash("errorSexe","Escull un Sexe de la llista!");
            return redirect()->back()->withInput();
        }


        session()->flash('usuariCreat','Compte creat!');

        $usuari = User::create($atributs) ;


        /** Assigna uns valors per defecte al pes i altura de l'usuari i posa la data del registre **/
        $pesAltura = new PesAltura();
        $pesAltura->pes = 0;
        $pesAltura->altura = 0;
        $pesAltura->data = date("Y-m-d");
        $pesAltura->user_id =  $usuari->id;
        $pesAltura->save();

        return redirect('/login');
    }
}
