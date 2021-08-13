<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <div>
                <h1 class="mb-0 font-bold">Gestió Dieta: {{$data}}</h1>
                <div class="grid grid-cols-2 place-content-end gap-3">
                    <div class="">
                        <div class="grid grid-cols-2 h-full place-content-center">
                            <div class="text-left w-full ml-20">
                                <p class="text-xl font-bold">Proteïnes consumides:</p>
                                <p class="text-xl font-bold">Carbohidrats consumits:</p>
                                <p class="text-xl font-bold">Greixos consumits:</p>
                                <p class="text-xl font-bold">Kilocalories totals:</p>
                            </div>
                            <div class="text-right ">
                                <p class="text-xl">{{$arrayNutrientsTotals[0]}}/ 120 gr</p>
                                <p class="text-xl">{{$arrayNutrientsTotals[1]}} / 120 gr</p>
                                <p class="text-xl">{{$arrayNutrientsTotals[2]}} / 120 gr</p>
                                <p class="text-xl">{{$arrayNutrientsTotals[3]}} / 2850 kcal</p>
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
                    </div>
                </div>
            </div>
            <div>
                <div class="grid grid-cols-1 gap-4 px-16">
                    @for ($i = 0; $i < $nombreApats; $i++)
                        <div class="bg-white border-2 border-black rounded-3xl p-3">
                            <div class="grid grid-cols-2">
                                <div class="text-left font-bold"><p>{{$nomsApats[$i]}}</p></div>
                                <div class="text-right">
                                    <p id="seccio{{$i}}">P: {{$arrayNutrientsApat[$i][0]}}gr | C: {{$arrayNutrientsApat[$i][1]}}gr | G: {{$arrayNutrientsApat[$i][2]}}gr | K: {{$arrayNutrientsApat[$i][3]}}kcal</p>
                                </div>
                            </div>
                            <hr class=" border-1 border-black">
                            <div class="mt-2">
                                <div class="grid grid-cols-8">
                                    @for($j= 0; $j < count($arrayAliments[$i]); $j++)
                                    <div class="border-2 border-black text-left col-span-7">
                                        <p class="pt-2 inline-block">{{$arrayAliments[$i][$j]["nom"]}}</p>
                                        <p class="inline-block float-right pt-2">{{$arrayAliments[$i][$j]["kilocalories"]}} kcal</p>
                                        <p class="inline-block float-right pt-2 mr-4">{{$arrayAliments[$i][$j]["pivot"]["mesura_quantitat"]}} g</p>
                                    </div>
                                    <div class="border-2 border-black">
                                        <img src="/imatges/esborra.png" alt="" width="35px" class="float-right cursor-pointer" onclick="alert('si')">
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="mt-4">
                <button class="botoEstandar w-56 mr-4">Afegeix aliments</button>
                <button class="botoDelete w-56">Esborra el dia</button>
            </div>
        </div>
    </div>
</div>
