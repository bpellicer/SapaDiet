<div class="contenidor">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-8/12 bg-green4 rounded-3xl border-2 border-black p-1 sm:p-5 text-center">
            <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">Progrés</h1>
            <div class="grid grid-cols-1" id="prog">
                <x-form method="POST" action="/addPesAltura" class="form">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-0">
                        <div class="divLabelPesAltura w-20">
                            <label for="pes" class="inline-block font-bold ">Pes: </label>
                        </div>
                        <div class="divAlturaPes">
                            <input type="number" name="pes" value="{{$pes}}" class="inputPesAltura" step="0.1">
                            <span>Kg</span>
                        </div>

                        <div class="divLabelPesAltura w-25">
                            <label for="altura" class="inline-block font-bold ">Altura: </label>
                        </div>
                        <div class="divAlturaPes">
                            <input type="number" name="altura" value="{{$altura}}" class="inputPesAltura">
                            <span>Cm</span>
                        </div>
                    </div>

                    <div id="errors">
                        @error('pes')
                            <p class="missatgeError">*{{ucfirst($message)}}</p>
                        @enderror
                        @error('altura')
                            <p class="missatgeError">*{{ucfirst($message)}}</p>
                        @enderror
                    </div>


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
            <div class="grafic chart-container">
                <canvas id="historicPes" aria-label="Histograma del teu pes de les últimes 7 dates on vas actualitzar el pes" role="img">
                    <p class="grafic_p">*El teu buscador no soporta aquest gràfic.</p>
                </canvas>
            </div>

            <div class="grafic chart-container">
                <canvas id="historicKcal" aria-label="Kilocalories consumides els últims 7 dies" role="img">
                    <p class="grafic_p">*El teu buscador no soporta aquest gràfic.</p>
                </canvas>
            </div>

        </div>
    </div>
</div>

