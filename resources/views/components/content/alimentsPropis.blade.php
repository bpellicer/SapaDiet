<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black px-2 sm:px-10 text-center">
            @if (count($aliments) === 0)
                <h1 class="font-bold mb-0 text-base sm:text-4xl">0 Aliments propis</h1>
                <div class="flex justify-center"><img src="/imatges/empty.png" class="w-96"></div>
                <div class="flex justify-center mb-4"><a class="botoPerfil w-full sm:w-96 text-xs sm:text-base" href="/cercador/afegeix_aliment">Comença a crear-ne!</a></div>
            @else
                <h1 class="text-base xs:text-xl sm:text-2xl md:text-3xl font-bold">Els meus Aliments</h1>
                <div class=" mb-4">
                    @foreach ($aliments as $aliment)
                        <a href="/cercador/aliments_propis/{{$aliment->nom}}" name="idAliment" class="w-40">
                            <div class="flex justify-center sm:inline-block">
                                <div class="cartaAliment">
                                    <img src="{{$aliment->categoria->imatge->url}}" alt="" class="inline-block">
                                    <p class="font-bold mt-2">{{$aliment->nom}}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
