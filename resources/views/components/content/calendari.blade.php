<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black px-2 2xs:p-4 md:p-10 text-center">
            <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">{{$mesNom}} de 20{{$any}}</h1>
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 text-center mb-4 gap-y-2">
                @for ($i = 1; $i<= $dies; $i++)
                    <a href="/calendari/{{$i}}-{{$mes}}-{{$any}}">
                        <div class="@if ($dia == $i) bg-green1 @elseif($i < $dia) bg-gray-400 @else bg-white @endif w-full h-20 border-2 border-black hover:bg-green5 cursor-pointer">
                            <div class="w-full border-b-2 border-black bg-white">
                                <h2 class="text-xs font-bold">{{$arrayDies[$i-1]}}</h2>
                            </div>
                            <h1 class="text-sm my-4">{{$i}}</h1>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
    </div>
</div>
