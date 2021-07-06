<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorRegistre extends Controller
{
    public function store(){
        //Crea l'usuari
        request()->validate([
            'name'=>'',
            'email'=>'',
            'password'=>'',

        ]);
    }
}
