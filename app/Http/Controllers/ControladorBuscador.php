<?php

namespace App\Http\Controllers;

use App\Models\Aliment;
use App\Models\AlimentPropi;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ControladorBuscador extends Controller
{
    /**
     * Funció que retorna la vista de "Cerca"
     */
    public function create(){
        $usuari = User::findOrFail(Auth::id());
        /** Controla que l'Usuari només pugui entrar al dia de la dieta si ha guardat la planificació **/
        if($usuari->planificacio_id == 1){
            session()->flash("planificacioDefecte","Guarda la planificació primer!");
            return redirect("/planificacio");
        }
        $descripcio = "Pàgina de Cerca que conté les tres opcions disponibles: Buscar Aliment, Crear Aliment o Aliments Propis";
        $title = "Sapa Diet | Cerca";
        return view("pages.cerca", compact("title","descripcio"));
    }

    /**
     * Funció que retorna la vista de "Crea Aliment" amb una array de totes les Categories
     */
    public function createAfegir(){

        $usuari = User::findOrFail(Auth::id());
        /** Controla que l'Usuari només pugui entrar al dia de la dieta si ha guardat la planificació **/
        if($usuari->planificacio_id == 1){
            session()->flash("planificacioDefecte","Guarda la planificació primer!");
            return redirect("/planificacio");
        }

        $title = "Sapa Diet | Crea Aliment";
        $descripcio = "Pàgina en la qual pots crear un Aliment Propi amb tota la informació nutricional que vulguis i amb un nom";
        return view("pages.afegeixAliment",[
            'categories' => Categoria::orderBy('nom')->get()
        ],compact("title","descripcio"));
    }

    /**
     * Funció que guarda un nou AlimentPropi amb les dades validades del $request. Després redirigeix a /cercador.
     * @param Request $request Conté les dades del formulari de creació d'aliments.
     */
    public function storeAfegir(Request $request){
        $atributs = $request->validate([
            'nom' => ['required','string','regex:/^[A-zÀ-ú ]*$/','max:20',Rule::unique('aliment_propis','nom')->where(
                function($query){
                    return $query->where('user_id',Auth::id());
                })
            ],
            'kcal' => ['required','numeric','min:0','max:1000'],
            'proteines' => ['required','numeric', 'max:1000', 'min:0'],
            'hidrats' => ['required','numeric', 'max:1000', 'min:0'],
            'greixos' => ['required','numeric', 'max:1000', 'min:0'],
            'categoria' => ['required']
        ]);

        $alimentPropi = $this->insertDadesAliment($atributs);

        $alimentPropi->save();

        session()->flash('alimentCreat','Aliment Creat!');

        return redirect("/cercador");
    }

    /**
     * Funció que retorna la vista de "Els Teus Aliments" que conté una array d'aliments propis de l'User
     */
    public function createPropis(){

        $usuari = User::findOrFail(Auth::id());
        /** Controla que l'Usuari només pugui entrar al dia de la dieta si ha guardat la planificació **/
        if($usuari->planificacio_id == 1){
            session()->flash("planificacioDefecte","Guarda la planificació primer!");
            return redirect("/planificacio");
        }

        $usuari = User::findOrFail(Auth::id());
        $title = "Sapa Diet | Els Meus Aliments";
        $descripcio = "Pàgina des d'on pots veure tots els Aliments Propis que has creat. Si encara no has creat cap, se't mostra un missatge per començar a crear-ne.";
        return view("pages.alimentsPropis",[
            'aliments' => $usuari->alimentpropi
        ],compact("title","descripcio"));
    }

    /**
     * Funció que retorna un nou Aliment Propi el qual pertany a un únic User i a una única Categoria
     * @param array $atributs Array que conté els atributs request validats del formulari
     */
    public function insertDadesAliment($atributs){
        $alimentPropi =  new AlimentPropi();
        $alimentPropi->nom = $atributs['nom'];
        $alimentPropi->proteines = $atributs['proteines'];
        $alimentPropi->hidrats =  $atributs['hidrats'];
        $alimentPropi->greixos =  $atributs['greixos'];
        $alimentPropi->kilocalories = $atributs['kcal'];
        $alimentPropi->categoria_id =  Categoria::where('nom','=',$atributs['categoria'])->firstOrFail()->id;
        $alimentPropi->user_id = User::findOrFail(Auth::id())->id;
        return $alimentPropi;
    }

    /**
     * Funció que retorna la vista del buscador i envia l'array de categories
     */
    public function createBuscador(){
        $usuari = User::findOrFail(Auth::id());
        /** Controla que l'Usuari només pugui entrar al dia de la dieta si ha guardat la planificació **/
        if($usuari->planificacio_id == 1){
            session()->flash("planificacioDefecte","Guarda la planificació primer!");
            return redirect("/planificacio");
        }

        $title = "Sapa Diet | Buscador d'aliments";
        $descripcio = "Pàgina que et retorna un buscador d'Aliments en la qual pots filtrar aquests pel nom o per la seva categoria";
        return view("pages.buscador",[
            'categories'        => Categoria::orderBy('nom')->get()
        ],compact("title","descripcio"));
    }

    /**
     * Funció que retorna els aliments corresponents a la petició AJAX del buscador d'Aliments
     * @param Request $request Conté el nom i la categoria de l'Aliment o Aliments a buscar.
     */
    public function getAliments(Request $request){
        if($request->ajax()){
            $nom = $request->get("name");
            $categoria = $request->get("cat");
            $aliments = "";

            if($nom == "" && $categoria != "-- Cap --"){
                $categoria = Categoria::where("nom","=",$categoria)->get();
                $aliments = Aliment::where("categoria_id","=",$categoria[0]->id)->orderBy("nom")->get();
            }
            else if($nom!="" && $categoria == "-- Cap --"){
                $aliments = Aliment::where("nom","like",$nom.'%')->orderBy("nom")->get();
            }
            else{
                $categoria = Categoria::where("nom","=",$categoria)->get();
                $aliments = Aliment::where("nom","like",$nom.'%')->where("categoria_id","=",$categoria[0]->id)->orderBy("nom")->get();
            }
            echo $aliments;
        }

    }
}
