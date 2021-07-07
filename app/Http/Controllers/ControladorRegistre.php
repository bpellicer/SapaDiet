<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ControladorRegistre extends Controller
{

    public function create(){
        return view('pages.registre');
    }

    public function store(Request $request){
        $atributs = $request->validate([
            'nom'=>['required','max:30'],
            'cognoms' =>['required','max:255'],
            'email'=>['required','max:255','email',Rule::unique('users','email')],
            'contrasenya'=>['required','min:8','max:255','same:password_confirmation'],
            'password_confirmation'=>['required','min:8','max:255']
        ]);

        User::create($atributs);

        return redirect('/login');
    }
}
