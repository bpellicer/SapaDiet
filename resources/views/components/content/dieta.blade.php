<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 lg: my-12">
        <div class="w-full lg:w-11/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black p-1 2xs:p-2 sm:p-5 text-center">
            <div class="w-10 mt-2">
                <a href="/calendari" class="w-10"><img class="w-10  transition ease-in transform hover:scale-110" src="/imatges/arrowleft.png" alt=""></a>
            </div>
            <div class="px-2">
                <h1 class="text-base xs:text-lg sm:text-2xl md:text-3xl mb-0 font-bold">Gestió Dieta: {{$data}}</h1>
                <div class="grid grid-cols-1 md:grid-cols-3 place-content-start lg:place-content-end gap-3">
                    <div class="row-start-2 md:row-start-1 md:col-span-2">
                        <div class="grid grid-cols-3 h-full place-content-center">
                            <div class="2xs:pl-10 text-left sm:pl-20 md:pl-0 w-20 md:ml-20 lg:ml-20">
                                <p class="pDieta font-bold">Proteïnes:</p>
                                <p class="pDieta font-bold">Carbohidrats: </p>
                                <p class="pDieta font-bold">Greixos:</p>
                                <p class="pDieta font-bold">Kilocalories:</p>
                            </div>
                            <div class="2xs:pr-10 sm:pr-20 md:pr-0 text-right col-span-2">
                                <p class="pDieta">{{$arrayNutrientsTotals[0]}} / {{round($kcalTotals * 0.25 / 4)}}gr</p>
                                <p class="pDieta">{{$arrayNutrientsTotals[1]}} / {{round($kcalTotals * 0.5 / 4)}}gr</p>
                                <p class="pDieta">{{$arrayNutrientsTotals[2]}} / {{round($kcalTotals * 0.25 / 9)}}gr</p>
                                <p class="pDieta">{{$arrayNutrientsTotals[3]}} / {{$kcalTotals}} kcal</p>
                            </div>
                        </div>
                    </div>
                    <div class="row-start-1 md:col-start-3 flex justify-center md:ml-10">
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
            <div class="mt-10 mb-10">
                <div class="grid grid-cols-1 gap-1 lg:px-16">
                    @for ($i = 0; $i < $nombreApats; $i++)
                    <div class="flex justify-end mr-5">
                        <x-form method="post" action="/randomApat" id="formRandom{{$i}}">
                            <input type="hidden" name="apat" value="{{$nomsApats[$i]}}">
                            <input type="hidden" name="nombreApats" value="{{$nombreApats}}">
                            <input type="hidden" name="data" value="{{$data}}">
                            <input type="hidden" name="kcalTotals" value="{{$kcalTotals}}">
                            <button type="submit" onclick="randomApat(event,{{$i}})"><img src="/imatges/random.png" alt="" class="random"></button>
                        </x-form>
                    </div>
                        <div class="bg-white border-2 border-black rounded-3xl p-2.5">
                            <div class="grid sm:grid-cols-3">
                                <div class="text-left font-bold text-sm md:text-base">
                                    <p class="inline-block">{{$nomsApats[$i]}}</p>
                                </div>
                                <div class="sm:text-right mt-2 sm:mt-0 col-span-2 grid grid-cols-4">
                                    <div id="seccio{{$i}}" class="divInfoAliment">P: {{$arrayNutrientsApat[$i][0]}}gr</div>
                                    <div id="seccio{{$i}}" class="divInfoAliment">C: {{$arrayNutrientsApat[$i][1]}}gr</div>
                                    <div id="seccio{{$i}}" class="divInfoAliment">G: {{$arrayNutrientsApat[$i][2]}}gr</div>
                                    <div id="seccio{{$i}}" class="divInfoAliment">K: {{$arrayNutrientsApat[$i][3]}}kcal</div>
                                </div>
                            </div>
                            <hr class=" border-1 border-black">
                            <div class="mt-4">
                                @for($j= 0; $j < count($arrayAliments[$i]); $j++)
                                    <div class="grid grid-cols-12 md:grid-cols-10 grid-rows-2 h-9 mb-4 place-items-center">
                                        <div class="row-span-2 col-span-2 md:col-span-1">
                                            <img src="{{$arrayImatges[$i][$j]}}" alt="{{$j}}">
                                        </div>
                                        <div class="row-span-2 col-span-5 w-full pl-1 text-mini sm:text-sm text-left">
                                            <p>{{$arrayAliments[$i][$j]["nom"]}}</p>
                                        </div>
                                        <div class="row-span-2 col-span-3 w-full text-mini sm:text-sm text-right">
                                            <p>{{round($arrayAliments[$i][$j]["kilocalories"] * ($arrayAliments[$i][$j]["pivot"]["mesura_quantitat"] / 100)) }} kcal</p>
                                            <p class="text-gray-500">{{$arrayAliments[$i][$j]["pivot"]["mesura_quantitat"]}} g</p>
                                        </div>
                                        <div class="row-span-2 col-span-2 md:col-span-1">
                                            <x-form method="post" action="/esborraAlimentApat">
                                                <input type="hidden" name="grams" value="{{$arrayAliments[$i][$j]["pivot"]["mesura_quantitat"]}}">
                                                <input type="hidden" name="idAliment" value="{{$arrayAliments[$i][$j]["id"]}}">
                                                <input type="hidden" name="data" value="{{$data}}">
                                                <input type="hidden" name="apat" value="{{$nomsApats[$i]}}">
                                                <button type="submit"><img src="/imatges/esborra.png" alt="" class="cursor-pointer w-7"></button>
                                            </x-form>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="mt-4 mb-4">
                <a class="botoDieta w-56 mb-4 sm:mr-4 inline-block" href="/cercador/cerca_aliments">Afegeix aliments</a>
                <x-form action="/esborraDia" method="post" class="inline-block" id="eliminaForm">
                    <input type="hidden" name="data" value="{{$data}}">
                    <button class="botoDelete w-56" type="submit" id="eliminaDia">Esborra el dia</button>
                </x-form>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Funció que genera una alerta amb confirmació per a generar un àpat aleatori.
     **/
    function randomApat(event,i){
        event.preventDefault();
        swal({
            title: "Estàs a punt de generar un àpat aleatori",
            text: "Si acceptes, els aliments que ja hi havia s'esborraran. N'estàs segur?",
            icon:'info',
            buttons:["Cancel·la","Sí, generar àpat"],
            closeOnClickOutside: false,
            dangerMode:true
        }).then((genera) => {
            if(genera){
                $("#formRandom"+i).submit();
            }
            else return false;
        });
    }
</script>
