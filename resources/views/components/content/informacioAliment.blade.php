<div class="container mx-auto my-auto">
    <div class="flex justify-center px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-8/12 bg-green4 rounded-3xl border-2 border-black p-5">
            <div class="bg-green1 border-2 border-black p-2 w-1/2 mx-auto rounded-3xl">
                <div class="w-full rounded-full">
                    <img src="{{$aliment[0]->categoria->imatge->url}}" alt="" class="mx-auto w-20">
                </div>
                <h1 class="">{{$aliment[0]->nom}}</h1>
                <p>Kilocalories: {{$aliment[0]->kilocalories}}</p>
                <p>Proteines: {{$aliment[0]->prtoeines}}</p>
                <p>Hidrats: {{$aliment[0]->hidrats}}</p>
                <p>Grasses: {{$aliment[0]->grasses}}</p>
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
</div>
