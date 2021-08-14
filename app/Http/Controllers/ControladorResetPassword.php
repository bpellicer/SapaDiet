<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ControladorResetPassword extends Controller
{
    public function createFormContra(){
        return view("auth.oblidaContra");
    }

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
            $message->subject('Reinicia Contrasenya');
        });

        session()->flash("missatge","Link enviat al teu Mail!");

        return back();

    }

    public function createReiniciaContra($token){
        return view('auth.reiniciaContra', ['token' => $token]);
    }

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
