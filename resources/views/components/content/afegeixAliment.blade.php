<div class="container mx-auto my-auto">
    <div class="flex justify-center px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-8/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <h1 class="font-semibold">Afegeix un aliment</h1>
            <x-form method="POST" action="/addAliment" class="form">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="font-semibold mr-2 block">Nom</label>
                        <input type="text" class="inputNutricional" id="nom" name="nom" placeholder="Nom"/>
                        @error('nom')
                            <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="categoria" class="font-semibold block">Categoria</label>
                        <select name="categoria" id="" class="rounded-2xl w-8/12 sm:w-10/12 mt-2" style="padding: 5.2px">
                            @foreach ($categories as $categoria)
                                <option name="{{$categoria->value}}">{{$categoria->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h2 class="text-xl md:text-2xl mt-10 mb-4 font-semibold underline">Valors energètics 100 grams</h2>
                <div class="grid gap-4 sm:grid-cols-2 mt-4">
                    <div>
                        <label for="proteines" class="labelNutricional">Proteïnes</label>
                        <input type="number" class="inputNutricional" id="proteines" name="proteines" placeholder="Proteïnes" step="any"/>
                        @error('proteines')
                            <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="hidrats" class="labelNutricional">Carbohidrats</label>
                        <input type="number" class="inputNutricional" id="hidrats" name="hidrats" placeholder="Carbohidrats" step="any"/>
                        @error('hidrats')
                            <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="grasses" class="labelNutricional">Grasses</label>
                        <input type="number" class="inputNutricional" id="grasses" name="grasses" placeholder="Grasses" step="any"/>
                        @error('grasses')
                            <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                        @enderror
                        </div>
                    <div>
                        <label for="kcal" class="labelNutricional">Kilocalories</label>
                        <input type="number" class="inputNutricional" id="kcal" name="kcal" placeholder="Kilocalories" step="any"/>
                        @error('kcal')
                            <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-center mt-3">
                   <button type="submit" class="botoPerfil" id="" name="">Afegeix aliment</button>
                </div>
            </x-form>
        </div>
    </div>
</div>
