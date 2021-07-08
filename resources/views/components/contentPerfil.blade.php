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
                    <form method="post" action="/esborraUsuari" class="mt-2" id="elimina">
                        <div class="flex justify-center">
                            <button type="submit" class="botoDelete w-full md:w-1/2" onclick="a(event)">Esborrar el compte</button>
                        </div>
                    </form>
                </div>
                <script>
                   function a(event){
                        event.preventDefault();
                        swal({
                            title: "Estas segur que vols esborrar el teu compte?",
                            text: "No seràs capaç de recuperar el teu usuari!",
                            icon:'warning',
                            buttons:['Cancel·la','Si, esborra el meu compte'],
                            closeOnClickOutside: false,
                            dangerMode:true
                        }).then((esborra) => {
                            if(esborra){
                                return true;
                            }
                        });
                   }
                </script>

        </div>
    </div>
</div>
