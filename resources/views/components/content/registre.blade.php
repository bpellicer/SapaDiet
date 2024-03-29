<div class="contenidor">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-100 bg-green4 rounded-3xl border-2 border-black p-2">
            <h3 class="pt-4 text-2xl text-center font-bold">Crea un compte!</h3>
            <x-form method="post" action="/registre" class="px-8 pt-6 pb-8 form" id="registreForm">

                <x-input tipus="text" classe="inputClassic" id="nom" nom="nom" placeholder="Nom"/>

                @error('nom')
                    <p class="missatgeError">{{ucfirst($message)}}</p>
                @enderror

                <x-input tipus="text" classe="inputClassic" id="cognoms" nom="cognoms" placeholder="Cognoms" />

                @error('cognoms')
                    <p class="missatgeError">{{ucfirst($message)}}</p>
                @enderror

                <div class="mb-2">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="sexe">Sexe</label>
                    <select name="sexe" id="sexe" class="inputClassic" value='{{old("sexe")}}'>
                        <option value="Home">Home</option>
                        <option value="Dona">Dona</option>
                    </select>
                </div>

                @if(session()->has("errorSexe"))
                    <p class="missatgeError">{{ session('errorSexe') }}</p>
                @endif

                <x-input tipus="number" classe="inputClassic" id="edat" nom="edat" placeholder="Edat" />

                @error('edat')
                    <p class="missatgeError">{{ucfirst($message)}}</p>
                @enderror

                <x-input tipus="email" classe="inputClassic" id="email" nom="email" placeholder="Email" />

                @error('email')
                    <p class="missatgeError">{{ucfirst($message)}}</p>
                @enderror

                <x-input tipus="password" classe="inputClassic contrasenya" nom="contrasenya" id="contra1" placeholder="Contrasenya"/>

                @error('contrasenya')
                    <p class="missatgeError">{{ucfirst($message)}}</p>
                @enderror

                <div class="mb-2 infoPass hidden">
                    <h2 class="text-xs text-gray-500 font-bold">La contrasenya ha de contenir com a mínim:</h2>
                    <ol class="text-xs text-gray-500">
                        <li>* 1 lletra minúscula</li>
                        <li>* 1 lletra majúscula</li>
                        <li>* 1 símbol</li>
                        <li>* 8 caràcters</li>
                    </ol>
                </div>

                <x-input tipus="password" classe="inputClassic contrasenya" nom="password_confirmation" id="contra2" placeholder="Repeteix Contrasenya" />

                @error('password_confirmation')
                    <p class="missatgeError">{{ucfirst($message)}}</p>
                @enderror

                <input id="btnPass" type="checkbox" name="checkbox" class="mr-1 mb-4"><label for="checkbox" id="labelPass" class="text-sm md:text-base">Mostra contrasenya</label>

                <div class="text-center">
                    <x-boto tipus="submit" classe="botoForm w-full" text="Registra't"/>
                </div>
            </x-form>
        </div>
    </div>
</div>
