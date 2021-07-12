
    <div class="divIntern" id="divIntern" hidden>
        <img src="/imatges/creu.png" class="creu" id="creu">
        <h1 class=" text-2xl">IMATGE DE PERFIL</h1>
        <x-form method="post" action="updateImatgePerfil" id="formImatgePerfil" class="form">
            <div class="gridImatges">
                @foreach ($imatges as $imatge)
                    <img src = "{{$imatge->url}}" width="150px" class="rounded-full bg-white cursor-pointer imatgePerfil">
                @endforeach
            </div>
        </x-form>
    </div>

