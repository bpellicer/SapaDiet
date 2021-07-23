<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ControladorRegistre extends Controller
{

    public function create(){
        $title = "Sapa Diet | Registre";
        return view('pages.registre',compact("title"));
    }

    public function store(Request $request){
        $atributs = $request->validate([
            'nom'=>['required','max:30','alpha'],
            'cognoms' =>['required','max:255','alpha'],
            'email'=>['required','max:255','email',Rule::unique('users','email')],
            'contrasenya'=>['required','max:255','same:password_confirmation',Password::min(8)->mixedCase()->symbols()],
            'password_confirmation'=>['required','min:8','max:255']
        ]);

        session()->flash('usuariCreat','Compte creat correctament!');

        User::create($atributs);

        return redirect('/login');
    }
}
