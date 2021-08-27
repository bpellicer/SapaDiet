<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ControladorLogin extends Controller
{
    /**
     * Funció que retorna la vista de la pàgina de Login
     */
    public function create(){
        $title = "Sapa Diet | Login";
        return view("pages.login",compact("title"));
    }

    /**
     * Funció que valida si l'email existeix i si la contrasenya del formulari coincideix amb la seva. Si és la primera
     * vegada que l'usuari entra a la web, el redirecciona a la planificació, altrament el redirecciona al perfil.
     * @param Request $request  Conté les dades de l'Usuari per iniciar sessió.
     */
    public function store(Request $request){
        $request->validate([
            'email'         =>['required','max:255','email',Rule::exists('users','email')],
            'contrasenya'   =>['required','min:8','max:255']
        ]);

        if(!Auth::attempt(['email'=>$request->get('email'), 'password'=>$request->get('contrasenya')])){
           throw ValidationException::withMessages([
                'contrasenya' => 'La contrasenya és incorrecta',
            ]);
        }

        session()->regenerate(); //Regenera la sessió per assignar un nou Id a l'Usuari i evitar possibles falles de seguretat
        $usuari = User::findOrFail(Auth::id());

        if($usuari->primera_vegada) return redirect("/planificacio");

        return redirect("/perfil");
    }

    /**
     * Funció que destrueix la sessió de l'Usuari i el redirecciona a la pàgina principal
     */
    public function destroy(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
