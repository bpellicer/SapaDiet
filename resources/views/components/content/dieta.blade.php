<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <div>
                <h1 class="mb-0">Gestió Dieta: {{$data}}</h1>
                <div class="grid grid-cols-2 place-content-end gap-3">
                    <div class="">
                        <div class="grid grid-cols-2 h-full place-content-center">
                            <div class="text-left w-full ml-20">
                                <p class="text-xl ">Proteïnes consumides:</p>
                                <p class="text-xl ">Carbohidrats consumits:</p>
                                <p class="text-xl ">Greixos consumits:</p>
                            </div>
                            <div class="text-right ">
                                <p class="text-xl">100 / 120 gr</p>
                                <p class="text-xl">20 / 120 gr</p>
                                <p class="text-xl">5 / 120 gr</p>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-center">
                        <svg id="svg" width="200" height="200" viewport="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <circle class="cercle" r="51" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"/>
                            <circle id="cercleOffset" r="60" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"/>
                            <circle id="cercleBar" r="60" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0" style="stroke-dashoffset: 452.389px;"/>
                            <circle class="cercle" r="69" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"/>
                            <text id="percentatge" text-anchor="middle" x="102" y="112" style="font-size: 32px;" >0 %</text>
                        </svg>
                        {{-- <h2 class="block">Kilocalories totals: 0 / 2850 kcal</h2> --}}
                    </div>
                </div>
            </div>
            <div>
                <div class="grid grid-cols-1 gap-4 px-16">
                    @for ($i = 0; $i < $nombreApats; $i++)
                        <div class="bg-white border-2 border-black rounded-3xl p-3">
                            <div class="grid grid-cols-2">
                                <div class="text-left font-bold"><p>{{$nomsApats[$i]}}</p></div>
                                <div class="text-right"><p>P: 0gr | C: 0gr | G: 0gr | K: 0kcal</p></div>
                            </div>
                            <hr class=" border-1 border-black">
                            <div class="mt-2">
                                @for($j= 0; $j < count($arrayAliments[$i]); $j++)
                                    <div class="w-full text-left">
                                        <p class="text-left mt-2 inline-block">{{$arrayAliments[$i][$j]["nom"]}}</p>
                                        <img src="/imatges/crea.png" alt="" width="20px" class="inline-block">
                                    </div>
                                @endfor
                            </div>
                            <img src="/imatges/afegeix.png" alt="" width="20px" class="inline-block">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
