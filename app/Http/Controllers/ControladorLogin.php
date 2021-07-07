<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ControladorLogin extends Controller
{
    public function create(){
        return view("pages.login");
    }

    public function store(Request $request){

        $request->validate([
            'email'=>['required','max:255','email',Rule::exists('users','email')],
            'contrasenya'=>['required','min:8','max:255']
        ]);

        if(!Auth::attempt(['email'=>$request->get('email'), 'password'=>$request->get('contrasenya')])){
           throw ValidationException::withMessages([
                'email' => 'No hem trobat a cap usuari amb aquest email'
            ]);
        }

        session()->regenerate();
        return redirect("/perfil");
    }

    public function destroy(){
        Auth::logout();
        return redirect('/')->with('success','Adeu!');
    }
}
