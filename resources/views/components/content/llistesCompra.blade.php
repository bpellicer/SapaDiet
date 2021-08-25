<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black px-2 2xs:p-4 md:p-10 text-center">
            <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">Llistes de la compra</h1>
            @if(count($llistesCompra) == 0)
            <div class="flex justify-center"><img src="/imatges/empty.png" class="w-96"></div>
            @else
                <div class="grid grid-cols-3">
                    @foreach ($llistesCompra as $llista)
                        <div class="{{$llista->classe}}">
                            <div class="">
                                <h1>{{$llista->titol}}</h1>
                            </div>
                            <div class="">
                                <a href="/llistes_compra/modifica_llista/{{$llista->titol}}">Clica</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="flex justify-center mb-4">
                <a class="botoPerfil w-full sm:w-96 text-xs sm:text-base" href="/llistes_compra/crea_llista">Comença a crear-ne!</a>
            </div>
        </div>
    </div>
</div>
