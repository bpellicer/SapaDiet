<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-10 my-12">
        <div class="w-full lg:w-8/12 xl:w-7/12 bg-green4 rounded-3xl border-2 border-black p-5">
            <div class="w-full rounded-full">
                <img src="{{$aliment[0]->categoria->imatge->url}}" alt="" class="mx-auto w-20">
            </div>
            <div class="flex justify-center text-center">
                <x-form method="post" action="/updateAliment" class="mt-2 inline-block w-96">
                    <input type="hidden" name="id" value="{{$aliment[0]->id}}">
                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold">{{$aliment[0]->nom}}</h2>
                    <h2 class="text-sm 2xs:text-base md:text-2xl mt-10 mb-4 font-semibold underline">Valors energètics 100 grams</h2>
                    <label for="kilocalories" class="labelGeneral ">Kilocalories</label>
                    <div class="kcal">
                        <input type="number" name="kilocalories" value="{{$aliment[0]->kilocalories}}" class="inputPerfil">
                    </div>
                    @error('kilocalories')
                        <p class="missatgeError">*{{ucfirst($message)}}</p>
                    @enderror

                    <label for="proteines" class="labelGeneral">Proteïnes</label>
                    <div class="gr">
                        <input type="number" name="proteines" value="{{$aliment[0]->proteines}}" class="inputPerfil">
                    </div>
                    @error('proteines')
                        <p class="missatgeError">*{{ucfirst($message)}}</p>
                    @enderror

                    <label for="hidrats" class="labelGeneral">Carbohidrats</label>
                    <div class="gr">
                        <input type="number" name="hidrats" value="{{$aliment[0]->hidrats}}" class="inputPerfil">
                    </div>
                    @error('hidrats')
                        <p class="missatgeError">*{{ucfirst($message)}}</p>
                    @enderror

                    <label for="greixos" class="labelGeneral">Greixos</label>
                    <div class="gr">
                        <input type="number" name="greixos" value="{{$aliment[0]->greixos}}" class="inputPerfil">
                    </div>
                    @error('greixos')
                        <p class="missatgeError">*{{ucfirst($message)}}</p>
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
            <div class="mt-4 mb-4  text-center">
                <h2 class="text-sm 2xs:text-base md:text-2xl mt-10 mb-4 font-semibold underline">Afegeix l'aliment a la teva dieta</h2>
                <div class="flex justify-center">
                    <x-form action="/afegeixAlimentDieta" method="post" class="w-96">
                        <input type="hidden" name="tipusAliment" value="propi"/>
                        <input type="hidden" name="alimentId" value="{{$aliment[0]->id}}">
                        <input type="hidden" name="alimentNom" value="{{$aliment[0]->nom}}">
                        <label for="data" class="labelGeneral">Data</label>
                        <input type="date" name="data" class="p-1 w-full mb-2 rounded-md" id="dataInput">

                        <label for="apat" class="labelGeneral">Àpat</label>
                        <select name="apat" class="text-sm rounded-md w-full mb-2" style="padding:5.2px">
                            <option>Esmorzar</option>
                            <option>Mig Matí</option>
                            <option>Dinar</option>
                            <option>Berenar</option>
                            <option>Sopar</option>
                        </select>
                        <label for="grams" class="labelGeneral">Grams</label>
                        <input type="number" name="grams" placeholder="Grams" class="inputPerfil" id="inputGrams" min=0 step="0.001">
                        <div class="flex justify-center">
                            <input type="submit" value="Afegeix" class="botoPerfil w-full md:w-80 mt-2">
                        </div>
                    </x-form>
                </div>
                <div id="errors" class="mt-4">
                    @error('grams')
                        <p class="missatgeError">* {{ucfirst($message)}}</p>
                    @enderror
                    @error('data')
                        <p class="missatgeError">* {{ucfirst($message)}}</p>
                    @enderror
                    @error('apat')
                        <p class="missatgeError">* {{ucfirst($message)}}</p>
                    @enderror

                    @if (session()->has('errorData'))
                        <p class="missatgeError">* {{ session('errorData') }}</p>
                    @endif

                    @if (session()->has('errorApat'))
                        <p class="missatgeError">* {{ session('errorApat') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
