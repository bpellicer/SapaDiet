<div class="container mx-auto my-auto">
    <div class="flex justify-center px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-10/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            @if (count($aliments) === 0)
                <h1 class="font-bold mb-0 text-base sm:text-4xl">0 Aliments propis</h1>
                <div class="flex justify-center"><img src="/imatges/empty.png"></div>
                <div class="flex justify-center"><a class="botoPerfil w-full sm:w-96 text-xs sm:text-base" href="/cercador/afegeix_aliment">Comença a crear-ne!</a></div>
            @else
                <h1>Els meus Aliments!</h1>
                <div class="grid justify-items-center sm:w-full grid-cols-2 sm:grid-cols-<?php if(count($aliments)<4) echo count($aliments); else echo "4"; ?> gap-4">
                    @foreach ($aliments as $aliment)
                        <div class=" bg-green1 rounded-3xl sm:w-full md:w-10/12 border-2 border-black hover:bg-green5 p-5 text-center cursor-pointer">
                            <img src="{{$aliment->categoria->imatge->url}}" alt="" width="70px">
                            <p>{{$aliment->nom}}</p>
                        </div>


                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>


{{-- {{$aliment->kilocalories}} Kcal.
{{$aliment->proteines}} g.
{{$aliment->grasses}} g.
{{$aliment->hidrats}} g.
{{$aliment->categoria->nom}} --}}
