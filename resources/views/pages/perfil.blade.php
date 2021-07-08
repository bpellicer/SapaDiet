@include('partials.headcontent')
    <x-nav>
        <x-slot name="linksnav">
            <x-linksnav navclass="navApp" btnclass="lg:hidden sm:mr-10">
                <a href="#" class="linksApp">Gestió Dieta</a>
                <a href="#" class="linksApp mt-3">Cerca</a>
                <a href="#" class="linksApp mt-3">Llistes Compra</a>
                <a href="#" class="linksApp mt-3">Planificació</a>
                <a href="#" class="linksApp mt-3">Progrés</a>
                <a href="#" class="linksApp mt-3">Perfil</a>
                <form action="logout" method="post">@csrf<input type="submit" href="logout" class="botoNavApp mt-3" value="Tanca Sessió"></form>
            </x-linksnav>
        </x-slot>
    </x-nav>
    <div class="contenidor">
        <div class="subcontenidor">
            <div class="contenidor-login">
                <div class="w-full bg-green4 p-5 rounded-3xl text-center">
                    <h2 class="text-center text-2xl">BENVINGUT/DA AL TEU PERFIL, {{auth()->user()->nom}}</h2>
                    <div class="mt-10">
                        <div class="md:w-1/4 h-auto md:inline-block w-full rounded-full">
                            <div class="text-center">
                                <img src="/imatges/cuate.png" alt="" width="200px" class=" border-4 border-black mx-auto rounded-full bg-white">
                                <div class="mt-2"><x-boto tipus="button" classe="botoForm w-full" text="Canvia imatge de perfil"></x-boto></div>
                            </div>
                        </div>
                        <div class="lg:w-2/3 bg-blue-400 md:inline-block w-full">
                            <x-form method="post" action="/updatePerfil" class="border-2 border-black">
                                <div class="my-5 mx-2 inline-block"><x-inputPerfil tipus="text" classe="mr-10 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow w-full" id="nom" nom="nom" placeholder="Nom"/></div>
                                <div class="my-5 mx-2 inline-block"><x-inputPerfil tipus="text" classe="mr-10 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow  w-full" id="cognoms" nom="cognoms" placeholder="Cognoms"/></div>
                                <div class="my-5 mx-2 inline-block"><x-inputPerfil tipus="email" classe="block mr-10 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow  w-full" id="email" nom="email" placeholder="Email"/></div>
                                <x-boto tipus="submit" classe="botoForm w-full" text="Actualitzar Dades"></x-boto>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<x-footer>
    <x-slot name="mapaweb">
        <x-mapaweb>
            <div class="flex flex-wrap">
                <x-columnaMapaWeb>
                    <x-slot name="titol1">Gestionar Dieta</x-slot>
                    <x-slot name="titol2">Cerca</x-slot>
                </x-columnaMapaWeb>
                <x-columnaMapaWeb>
                    <x-slot name="titol1">Llistes Compra</x-slot>
                    <x-slot name="titol2">Planificació</x-slot>
                </x-columnaMapaWeb>
                <x-columnaMapaWeb>
                    <x-slot name="titol1">Progrés</x-slot>
                    <x-slot name="titol2">Perfil</x-slot>
                </x-columnaMapaWeb>
            </div>
        </x-mapaweb>
    </x-slot>
</x-footer>
