<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black px-2 2xs:p-4 md:p-10 text-center">
            <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">Llistes de la compra</h1>
            @if(count($llistesCompra) == 0)
            <div class="flex justify-center"><img src="/imatges/empty.png" class="w-96"></div>
            @else
                <div class="grid sm:grid-cols-2 gap-4 mb-8">
                    @foreach ($llistesCompra as $llista)
                        <div class="{{$llista->classe}} border-2 border-black h-20 md:w-64 xl:w-96 lg:mx-auto">
                            <div>
                                <h1 class="text-sm font-bold">{{$llista->titol}}</h1>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="mx-auto my-auto">
                                    <a href="/llistes_compra/modifica_llista/{{$llista->titol}}" class="w-6">
                                        <img src="/imatges/editLlista.png" class="w-6 mb-0">
                                    </a>
                                </div>
                                <div class="mx-auto">
                                    <x-form method="post" action="esborraLlista" class="h-8 pt-0.5">
                                        <input type="hidden" name="nom" value="{{$llista->titol}}">
                                        <button type="submit">
                                            <img src="/imatges/esborra.png" class="w-8 object-contain">
                                        </button>
                                    </x-form>
                                </div>
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
