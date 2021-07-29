<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-8/12 bg-green4 rounded-3xl border-2 border-black p-5">

                <div class="w-full rounded-full">
                    <img src="{{$aliment[0]->categoria->imatge->url}}" alt="" class="mx-auto w-20">
                </div>
                <x-form method="post" action="/updateAliment" class="mt-2">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" value="{{$aliment[0]->nom}}" class="block p-2 rounded-lg w-full sm:w-1/2 mb-4">
                    <label for="kilocalories">Kcal</label>
                    <input type="number" name="kilocalories" value="{{$aliment[0]->kilocalories}}" class="block p-2 rounded-lg w-full sm:w-1/2 mb-4">
                    <label for="proteines">Proteines</label>
                    <input type="number" name="proteines" value="{{$aliment[0]->proteines}}" class="block p-2 rounded-lg w-full sm:w-1/2 mb-4">
                    <label for="hidrats">Hidrats</label>
                    <input type="number" name="hidrats" value="{{$aliment[0]->hidrats}}" class="block p-2 rounded-lg w-full sm:w-1/2 mb-4">
                    <label for="grasses">Grasses</label>
                    <input type="number" name="grasses" value="{{$aliment[0]->grasses}}" class="block p-2 rounded-lg w-full sm:w-1/2 mb-4">
                    <button type="submit" class="botoPerfil w-full md:w-1/2">Actualitza les dades</button>
                </x-form>
                <x-form method="post" action="/esborraAliment" class="mt-2" id="eliminaForm">
                    @csrf
                    <input type="hidden" name="alimentId" value="{{$aliment[0]->id}}">
                    <div class="flex justify-center">
                        <button type="button" class="botoDelete w-full md:w-1/2" id="eliminaAliment">Esborra l'aliment</button>
                    </div>
                </x-form>

        </div>
    </div>
</div>
