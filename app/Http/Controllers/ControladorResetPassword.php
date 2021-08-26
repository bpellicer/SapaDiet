<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ControladorResetPassword extends Controller
{
    /**
     * Funció que retorna la vista d'OblidaContrasenya
     */
    public function createFormContra(){
        return view("auth.oblidaContra");
    }

    /**
     * Funció que valida l'email del $request, crea un token aleatori de 64 caràcters, insereix una fila a la taula de password_resets i finalment
     * envia un mail a l'adreça email corresponent.
     * @param Request $request  Conté l'adreca de correu electrònic de l'Usuari (email)
     */
    public function submitFormContra(Request $request){
        $request->validate([
            "email" => ["required","email",Rule::exists("users","email")]
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.oblidaPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reinicia la Contrasenya');
        });

        session()->flash("missatge","Link enviat al teu Mail!");

        return back();

    }

    /**
     * Funció que retorna la vista del formulari de reinici de contrasenya amb el token que es rep des del link del mail
     * @param String $token     Conté un token de 64 caràcters de longitud
     */
    public function createReiniciaContra($token){
        return view('auth.reiniciaContra', ['token' => $token]);
    }

    /**
     * Funció que valida les dades del $request i actualitza el camp de la contrasenya de l'Usuari.
     * A continuació esborra les files de la taula password_resets que coincideixen amb l'adreça email de l'Usuari
     * @param Request $request      Conté l'email i la nova contrasenya
     */
    public function submitReiniciaContra(Request $request){
        $request->validate([
            'email'                 => ['required','email',Rule::exists("users","email")],
            'contrasenya'           => ['required','max:255','same:password_confirmation',Password::min(8)->mixedCase()->symbols()],
            'password_confirmation' => ['required','min:8','max:255']
        ]);

        $updateContra = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

        if(!$updateContra){
            session()->flash("error","Token invàlid!");
            return back();
        }

        $usuari = User::where("email",$request->email)->first();
        $usuari->contrasenya = $request->contrasenya;

        $usuari->save();

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        session()->flash("missatge","Contrasenya reiniciada!");

        return redirect('/login');
    }
}
