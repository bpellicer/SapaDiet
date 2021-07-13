<div class="container mx-auto my-auto">
    <div class="flex justify-center px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-7/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <h2 class="text-center text-2xl">BENVINGUT/DA AL TEU PERFIL, {{auth()->user()->nom}}</h2>
            <div class="md:inline-block w-full text-center mt-4">
                <img id = "imatgePerfil" src="{{auth()->user()->imatge->url}}" alt="" width="300px" class="mx-auto rounded-full bg-white cursor-pointer imatgePerfil">
            </div>
            <div class="w-2/3 inline-block mt-3">
                <x-form method="post" action="/updatePerfil" class="form" id="updateForm">
                    <x-inputPerfil tipus="text" classe="inputPerfil" id="nom" nom="nom" placeholder="Nom"/>
                    <x-inputPerfil tipus="text" classe="inputPerfil" id="cognoms" nom="cognoms" placeholder="Cognoms"/>
                    <x-inputPerfil tipus="email" classe="inputPerfil" id="email" nom="email" placeholder="Email"/>
                    <div class="flex justify-center"><x-boto tipus="submit" classe="botoPerfil w-full md:w-1/2" text="Actualitzar Dades"></x-boto></div>
                </x-form>
                <x-form method="post" action="/esborraUsuari" class="mt-2" id="eliminaForm">
                    @csrf
                    <div class="flex justify-center">
                        <button type="button" class="botoDelete w-full md:w-1/2" id="eliminaPerfil">Esborrar el compte</button>
                    </div>
                </x-form>
            </div>

            @include("components.imatges")
        </div>
    </div>
</div>
