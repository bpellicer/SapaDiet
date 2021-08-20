<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-8/12 bg-green4 rounded-3xl border-2 border-black p-1 sm:p-5 text-center">
            <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">Progrés</h1>
            <div class="grid grid-cols-1" id="prog">
                <x-form method="POST" action="/addPesAltura" class="form">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-0">
                        <div class="p-3 place-self-center sm:place-self-end sm:mb-2 inline-block w-20">
                            <label for="pes" class="inline-block font-bold ">Pes: </label>
                        </div>
                        <div class="p-3 place-self-start inline-block sm:w-40">
                            <input type="number" name="pes" value="{{$pes}}" class="rounded-2xl p-2 sm:mt-2 w-16 sm:w-20 inline-block">
                            <span>Kg</span>
                        </div>

                        <div class="p-3 place-self-center sm:place-self-end sm:mb-2 inline-block w-25">
                            <label for="altura" class="inline-block font-bold ">Altura: </label>
                        </div>
                        <div class="p-3 place-self-start inline-block sm:w-40">
                            <input type="number" name="altura" value="{{$altura}}" class="rounded-2xl p-2 sm:mt-2 w-16 sm:w-20 inline-block">
                            <span>Cm</span>
                        </div>

                    </div>
                    @error('pes')
                        <p class="text-xs text-red-500 mb-2 font-bold">*{{ucfirst($message)}}</p>
                    @enderror
                    @error('altura')
                        <p class="text-xs text-red-500 mb-2 font-bold">*{{ucfirst($message)}}</p>
                    @enderror

                    <div class="mt-4">
                        <input type="submit" class="botoEstandar cursor-pointer" value="Guardar">
                    </div>
                </x-form>
                <div class="mt-4">
                    <h2 class="font-bold">El teu IMC corporal és: {{$imc}}</h2>
                    <p class="mr-1 inline-block mt-4">Taula IMC</p><img src="imatges/imcTriangle1.png" alt="" width="15px" id="showImc" class="inline-block cursor-pointer">
                    <div id="infoImc" class="flex justify-center mt-4 mb-4"></div>
                </div>
            </div>
            <div class="px-1 sm:px-3 md:px-10 mb-4 chart-container" style="position: relative; heigth:80vh;">
                <canvas id="historicPes" aria-label="Histograma del teu pes de les últimes 7 dates on vas actualitzar el pes" role="img" class="bg-white border-2 border-black rounded-lg px-2">
                    <p class="text-mini xs:text-xs sm:text-sm text-red-500 font-bold">*El teu buscador no soporta aquest gràfic.</p>
                </canvas>
            </div>

            <div class="chart-container px-1 sm:px-3 md:px-10 mb-4" style="position: relative height:80vh;">
                <canvas id="historicKcal" aria-label="Kilocalories consumides els últims 7 dies" role="img" class="bg-white border-2 border-black rounded-lg px-2">
                    <p class="text-mini xs:text-xs sm:text-sm text-red-500 font-bold">*El teu buscador no soporta aquest gràfic.</p>
                </canvas>
            </div>

        </div>
    </div>
</div>

