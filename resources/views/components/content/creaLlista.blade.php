<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black px-2 2xs:p-4 md:p-6 text-center">
            @if ($accio == "afegir")
                <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">Crea la Llista</h1>
            @elseif ($accio == "modificar")
                <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">Modifica la Llista</h1>
            @endif
           <div class="mx-auto">
                <x-form method="post" action="/createUpdateList" class="mx-auto">
                    <input type="hidden" name="accio" value="{{$accio}}">
                    <div id="llistaCompra" class="llistaCompra">
                        <div class="grid sm:grid-cols-2">
                            <div><h1 class="font-bold text-3xl my-2">Títol</h1></div>
                            <div class="align-middle flex sm:mr-1">
                                <input type="text" name="titol" value="{{old('titol')}}" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow w-40 2xs:w-60 my-2 mx-auto">

                            </div>
                            @error('titol')
                                <p class="missatgeError sm:col-start-2">* {{ucfirst($message)}}</p>
                            @enderror

                        </div>
                        <div class="grid sm:grid-cols-2">
                            <div><h1 class="font-bold text-3xl">Estil</h1></div>
                            <div class="grid grid-cols-4 place-content-center mx-auto gap-1 xs:gap-2 2xs:gap-4 sm:gap-1 md:gap-1">
                                <div class="w-12 h-12 sm:w-14 sm:h-14">
                                    <x-labelRadio2 for="classic" src="/imatges/classic.png" value="classic"/>
                                </div>
                                <div class="w-12 h-12 sm:w-14 sm:h-14">
                                    <x-labelRadio2 for="banana" src="/imatges/banana.png" value="banana"/>
                                </div>
                                <div class="w-12 h-12 sm:w-14 sm:h-14">
                                    <x-labelRadio2 for="loto" src="/imatges/loto.png" value="loto"/>
                                </div>
                                <div class="w-12 h-12 sm:w-14 sm:h-14">
                                    <x-labelRadio2 for="ploma" src="/imatges/ploma.png" value="ploma"/>
                                </div>
                            </div>
                            @error('estil')
                                <p class="missatgeError sm:col-start-2 mt-2 sm:mt-0">* {{ucfirst($message)}}</p>
                             @enderror
                        </div>


                        <div class="grid sm:grid-cols-2">
                            <div class="sm:col-span-2"><h1 class="font-bold text-3xl">Productes</h1></div>
                            <div class="grid sm:grid-cols-2 sm:col-span-2 border-2 border-black mx-3 sm:mx-10" id="infoProducte">
                                <div><h2 class="text-xl font-bold my-3">Quantitat</h2></div>
                                <div id="divQuantitat" class="align-middle flex sm:mr-1">
                                    <input type="number" name="quantitatsProducte[]" id="quantitatProducte" class="w-20 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow my-2 mx-auto">
                                </div>
                                @error('quantitatsProducte.*')
                                    <p class="missatgeError sm:col-start-2">* {{ucfirst($message)}}</p>
                                @enderror

                                <div><h2 class="text-xl font-bold my-3">Nom</h2></div>
                                <div id="divInput" class="align-middle flex sm:mr-1">
                                    <input type="text" name="nomsProducte[]" id="nomProducte" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow w-40 2xs:w-60 my-2 mx-auto">
                                </div>
                                @error('nomsProducte.*')
                                    <p class="missatgeError sm:col-start-2">* {{ucfirst($message)}}</p>
                                @enderror

                            </div>
                        </div>
                        <div class="mb-4 mt-4 flex justify-center">
                            <img src="/imatges/add.png" class="w-5 cursor-pointer" alt="" id="addProducte">
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="botoEstandar">Guardar</button>
                    </div>

                </x-form>

           </div>
        </div>
    </div>
</div>
