<div class="divIntern" id="divIntern" hidden>
    <img src="/imatges/creu.png" class="creu" id="creu">
    <h1 class="text-lg sm:text-2xl">IMATGE DE PERFIL</h1>
    <x-form method="post" action="updateImatgePerfil" id="formImatgePerfil">
        <div class="gridImatges">
                @foreach ($imatges as $imatge)
                    <label for="{{$imatge->id}}" class="rounded-full">
                        <input id="{{$imatge->id}}" type="radio" name="imatge" value="{{$imatge->id}}" class="radio"
                            @if ($imatge->id === auth()->user()->imatge->id)
                                checked
                            @endif
                        >
                        <img src ="{{$imatge->url}}" width="150px" class="rounded-full bg-white cursor-pointer imatgePerfil" name="{{$imatge->id}}">
                    </label>
                @endforeach
        </div>
        <x-boto classe="botoEstandar mt-3" tipus="submit" text="Guarda"/>
    </x-form>
</div>
