<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black px-2 2xs:p-4 md:p-6 text-center">
            <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">Crea la Llista</h1>
           <div class="mx-auto">
                <x-form method="post" action="/createUpdateList" class="mx-auto">
                    <div id="llistaCompra" class="border-2 border-black w-full md:w-3/4 mb-4 mx-auto">
                        <div class="grid sm:grid-cols-2">
                            <div><h1 class="font-bold text-3xl my-2">Títol</h1></div>
                            <div class="align-middle flex sm:mr-1">
                                <input type="text" name="titol" value="" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow w-40 2xs:w-60 my-2 mx-auto">
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-2">
                            <div><h1 class="font-bold text-3xl">Estil</h1></div>
                            <div class="grid grid-cols-4 place-content-center mx-auto gap-1 xs:gap-2 2xs:gap-4 md:gap-5">
                                <div class="w-10 h-10 border-black border-2"></div>
                                <div class="w-10 h-10 border-black border-2"></div>
                                <div class="w-10 h-10 border-black border-2"></div>
                                <div class="w-10 h-10 border-black border-2"></div>
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-2">
                            <div class="sm:col-span-2"><h1 class="font-bold text-3xl">Productes</h1></div>
                            <div class="grid sm:grid-cols-2 sm:col-span-2 border-2 border-black mx-10" id="infoProducte">
                                <div><h2 class="text-xl font-bold">Quantitat</h2></div>
                                <div id="divQuantitat" class="align-middle flex sm:mr-1">
                                    <input type="number" name="" id="" class="w-20 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow my-2 mx-auto">
                                </div>

                                <div><h2 class="text-xl font-bold">Nom</h2></div>
                                <div id="divInput" class="align-middle flex sm:mr-1">
                                    <input type="text" name="" id="" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow w-40 2xs:w-60 my-2 mx-auto">
                                </div>
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
