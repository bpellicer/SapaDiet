<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <h1 class="font-bold text-lg sm:text-xl md:text-2xl lg:text-3xl">Cercador d'Aliments</h1>
            <div id="cercaDiv">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <x-inputText classe="inputNutricional" id="buscadorNom" nom="nom" tipus="text" placeholder="Entra un nom" />
                    </div>
                    <div>
                        <select name="categoria" id="categoria" class="rounded-2xl w-8/12 sm:w-10/12 mt-2" style="padding: 5.2px">
                            <option name="senseValor">-- Cap --</option>
                            @foreach ($categories as $categoria)
                                <option name="{{$categoria->value}}">{{$categoria->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-center mt-7">
                    <button type="button" class="botoPerfil w-40" id="cercaAliment">Cerca</button>
                </div>
            </div>
            <div id="content">

            </div>
        </div>
    </div>
</div>