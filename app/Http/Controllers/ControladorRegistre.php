<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ControladorRegistre extends Controller
{

    public function create(){
        return view('pages.registre');
    }

    public function store(Request $request){

        $atributs = $request->validate([
            'nom'=>['required','max:30'],
            'cognoms' =>['required','max:255'],
            'email'=>['required','max:255','email'],
            'contrasenya'=>['required','min:8'],

        ]);
        User::create($atributs);
        return redirect('/login');
    }
}
