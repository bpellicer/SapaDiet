<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black px-2 2xs:p-4 md:p-10 text-center">
            <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">Llistes de la compra</h1>
            @if(count($llistesCompra) == 0)
                <img src="" alt="">
            @else
                @foreach ($llistesCompra as $llista)
                    <div>

                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
