<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-8/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <h1 class="text-xl sm:text-3xl font-semibold">Afegeix un aliment</h1>
            <x-form method="POST" action="/addAliment" class="form">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="font-semibold mr-2 block">Nom</label>
                        <x-inputText tipus="text" classe="inputNutricional" id="nom" nom="nom" placeholder="Nom"/>
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
                <h2 class="text-sm 2xs:text-base md:text-2xl mt-10 mb-4 font-semibold underline">Valors energètics 100 grams</h2>
                <div class="grid gap-4 sm:grid-cols-2 mt-4">
                    <div>
                        <label for="proteines" class="labelNutricional">Proteïnes</label>
                        <x-inputNumber tipus="number" classe="inputNutricional" id="proteines" placeholder="Proteïnes" step="any"/>
                        @error('proteines')
                            <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="hidrats" class="labelNutricional">Carbohidrats</label>
                        <x-inputNumber tipus="number" classe="inputNutricional" id="hidrats" placeholder="Carbohidrats" step="any"/>
                        @error('hidrats')
                            <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="greixos" class="labelNutricional">Greixos</label>
                        <x-inputNumber tipus="number" classe="inputNutricional" id="greixos" placeholder="Greixos" step="any"/>
                        @error('greixos')
                            <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                        @enderror
                        </div>
                    <div>
                        <label for="kcal" class="labelNutricional">Kilocalories</label>
                        <x-inputNumber tipus="number" classe="inputNutricional" id="kcal" placeholder="Kilocalories" step="any"/>
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
