<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ControladorLogin extends Controller
{
    public function create(){
        return view("pages.login");
    }

    public function store(Request $request){
        ddd($request);
        $atributs = $request->validate([
            'email'=>['required','max:255','email',Rule::exists('users','email')],
            'contrasenya'=>['required','min:8','max:255']
        ]);

        if(Auth::attempt($atributs)){
            $request->session()->regenerate();
            return redirect("/login");
        }
        return back()->withErrors([
            'email'=>'No existeix un usuari amb aquestes credencials',
        ]);
    }

    public function destroy(){

    }
}
