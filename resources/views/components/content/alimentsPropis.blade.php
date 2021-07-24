<div class="container mx-auto my-auto">
    <div class="flex justify-center px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-7/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            @if (count($aliments) === 0)
                <h1 class="font-bold mb-0">0 Aliments propis</h1>
                <div class="flex justify-center"><img src="/imatges/empty.png"></div>
            @else
                <h1>Els meus Aliments!</h1>
                <div class="grid w-1/3 sm:w-full sm:grid-cols-4 gap-2">
                    @foreach ($aliments as $aliment)
                        <div class=" bg-green1 rounded-3xl border-2 border-black hover:bg-green5 p-5 text-center cursor-pointer">
                            <img src="{{$aliment->imatge->url}}" alt="" width="70px">
                            <p>{{$aliment->nom}}</p>
                        </div>

                        {{-- {{$aliment->kilocalories}} Kcal.
                        {{$aliment->proteines}} g.
                        {{$aliment->grasses}} g.
                        {{$aliment->hidrats}} g.
                        {{$aliment->categoria->nom}} --}}

                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

