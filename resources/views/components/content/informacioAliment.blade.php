<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-10 my-12">
        <div class="w-full lg:w-8/12 xl:w-7/12 bg-green4 rounded-3xl border-2 border-black p-5">
            <div class="w-full rounded-full">
                <img src="{{$aliment[0]->categoria->imatge->url}}" alt="" class="mx-auto w-20">
            </div>
            <div class="flex justify-center text-center">
                <x-form method="post" action="/updateAliment" class="mt-2 inline-block w-96">
                    <input type="hidden" name="id" value="{{$aliment[0]->id}}">

                    <label for="nom" class="labelGeneral">Nom</label>
                    <input type="text" name="nom" value="{{$aliment[0]->nom}}" class="inputPerfil">
                    @error('nom')
                        <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                    @enderror

                    <h2 class="text-xl md:text-2xl mt-2 mb-4 font-semibold underline">Valors energètics 100 grams</h2>
                    <label for="kilocalories" class="labelGeneral ">Kcal</label>
                    <div class="kcal">
                        <input type="number" name="kilocalories" value="{{$aliment[0]->kilocalories}}" class="inputPerfil">
                    </div>
                    @error('kilocalories')
                        <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                    @enderror

                    <label for="proteines" class="labelGeneral">Proteines</label>
                    <div class="gr">
                        <input type="number" name="proteines" value="{{$aliment[0]->proteines}}" class="inputPerfil">
                    </div>
                    @error('proteines')
                        <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                    @enderror

                    <label for="hidrats" class="labelGeneral">Hidrats</label>
                    <div class="gr">
                        <input type="number" name="hidrats" value="{{$aliment[0]->hidrats}}" class="inputPerfil">
                    </div>
                    @error('hidrats')
                        <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                    @enderror

                    <label for="greixos" class="labelGeneral">Greixos</label>
                    <div class="gr">
                        <input type="number" name="greixos" value="{{$aliment[0]->greixos}}" class="inputPerfil">
                    </div>
                    @error('greixos')
                        <p class="text-xs text-red-500 mb-2">*{{ucfirst($message)}}</p>
                    @enderror

                    <button type="submit" class="botoPerfil w-full">Actualitza les dades</button>
                </x-form>
            </div>
            <x-form method="post" action="/esborraAliment" class="mt-2" id="eliminaForm">
                <input type="hidden" name="alimentId" value="{{$aliment[0]->id}}">
                <div class="flex justify-center">
                    <button type="button" class="botoDelete w-96" id="eliminaAliment">Esborra l'aliment</button>
                </div>
            </x-form>
        </div>
    </div>
</div>
