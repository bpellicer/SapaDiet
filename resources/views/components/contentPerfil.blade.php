<div class="container mx-auto my-auto">
    <div class="flex justify-center px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-7/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <h2 class="text-center text-2xl">BENVINGUT/DA AL TEU PERFIL, {{auth()->user()->nom}}</h2>
                <div class="md:inline-block w-full text-center mt-4">
                    <img src="/imatges/defaultImage.png" alt="" width="300px" class=" border-4 border-black mx-auto rounded-full bg-white cursor-pointer imatgePerfil" onclick="alert('hola')">
                </div>
                <div class="w-2/3 inline-block mt-3">
                    <x-form method="post" action="/updatePerfil" class="form">
                        <x-inputPerfil tipus="text" classe="inputPerfil" id="nom" nom="nom" placeholder="Nom"/>
                        <x-inputPerfil tipus="text" classe="inputPerfil" id="cognoms" nom="cognoms" placeholder="Cognoms"/>
                        <x-inputPerfil tipus="email" classe="inputPerfil" id="email" nom="email" placeholder="Email"/>
                        <div class="flex justify-center"><x-boto tipus="submit" classe="botoPerfil w-full md:w-1/2" text="Actualitzar Dades"></x-boto></div>
                    </x-form>
                    <x-form method="post" action="/esborraUsuari" class="mt-2">
                        <div class="flex justify-center"><x-boto tipus="submit" classe="botoDelete w-full md:w-1/2" text="Esborrar el compte"></x-boto></div>
                    </x-form>
                </div>
        </div>
    </div>
</div>
