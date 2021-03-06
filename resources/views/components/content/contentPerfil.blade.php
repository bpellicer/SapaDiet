<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-7/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <h2 class="text-center text-base sm:text-2xl font-semibold">BENVINGUT/DA AL TEU PERFIL, {{auth()->user()->nom}}</h2>
            <div class="md:inline-block w-full text-center mt-4">
                <img id = "imatgePerfil" src="{{auth()->user()->imatge->url}}" alt="" width="300px" class="mx-auto rounded-full bg-white cursor-pointer imatgePerfil">
            </div>
            <div class="w-full sm:w-2/3 inline-block mt-3">
                <x-form method="post" action="/updatePerfil" class="form" id="updateForm">
                    <x-inputPerfil tipus="text" classe="inputPerfil" id="nom" nom="nom" placeholder="Nom"/>
                    @error('nom')
                        <p class="missatgeError text-left">{{ucfirst($message)}}</p>
                     @enderror

                    <x-inputPerfil tipus="text" classe="inputPerfil" id="cognoms" nom="cognoms" placeholder="Cognoms"/>
                    @error('cognoms')
                        <p class="missatgeError text-left">{{ucfirst($message)}}</p>
                     @enderror

                    <x-inputPerfil tipus="number" classe="inputPerfil" id="edat" nom="edat" placeholder="Edat"/>
                    @error('edat')
                        <p class="missatgeError text-left">{{ucfirst($message)}}</p>
                    @enderror

                    <label class="block text-sm font-bold text-gray-700 text-left" for="sexe">Sexe</label>
                    <select name="sexe" id="sexe" class="inputClassic mb-3">
                        <option value="Home" >Home</option>
                        <option value="Dona" @if(auth()->user()->sexe == "Dona") selected @endif>Dona</option>
                    </select>
                    @if(session()->has("errorSexe"))
                        <p class="missatgeError text-left">{{ session('errorSexe') }}</p>
                    @endif

                    <div class="flex justify-center mt-4"><x-boto tipus="submit" classe="botoPerfil w-full md:w-1/2" text="Actualitzar Dades"></x-boto></div>
                </x-form>
                <x-form method="post" action="/esborraUsuari" class="mt-2" id="eliminaForm">
                    <div class="flex justify-center">
                        <button type="button" class="botoDelete w-full md:w-1/2" id="eliminaPerfil">Esborrar el compte</button>
                    </div>
                </x-form>
            </div>

            @include("components.content.imatges")
        </div>
    </div>
</div>
