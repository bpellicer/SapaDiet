<?php

namespace App\Http\Controllers;

use App\Models\AlimentPropi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorAliment extends Controller
{
    public function create($nom){
        $title = 'Sapa Diet | Informació '.$nom;
        $alimentPropi = AlimentPropi::where("nom","=",$nom)->where('user_id','=',Auth::id())->get();
        if($alimentPropi->count() == 0){
            return view("errors.404");
        }
        return view('pages.informacioAliment',[
            "aliment" => $alimentPropi
        ], compact('title'));
    }

    public function delete(Request $request){
        $aliment = AlimentPropi::findOrFail($request->get("alimentId"));
        $aliment->delete();
        session()->flash('alimentEsborrat','Aliment esborrat!');
        return redirect("/cercador/aliments_propis");
    }
}
