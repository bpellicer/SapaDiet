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
    <div class="container mx-auto my-auto">
        <div class="flex justify-center px-10 my-12">
            <div class="w-full lg:w-9/12 xl:w-7/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
                <h2 class="text-center text-2xl">BENVINGUT/DA AL TEU PERFIL, {{auth()->user()->nom}}</h2>
                    <div class="md:inline-block w-full text-center mt-2">
                        <img src="/imatges/defaultImage.png" alt="" width="300px" class=" border-4 border-black mx-auto rounded-full bg-white cursor-pointer" onclick="alert('hola')">
                    </div>
                    <div class="w-2/3 inline-block mt-3">
                        <x-form method="post" action="/updatePerfil" class="form">
                            <x-inputPerfil tipus="text" classe=" mb-3 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow w-full" id="nom" nom="nom" placeholder="Nom"/>
                            <x-inputPerfil tipus="text" classe=" mb-3 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow  w-full" id="cognoms" nom="cognoms" placeholder="Cognoms"/>
                            <x-inputPerfil tipus="email" classe=" mb-3 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow  w-full" id="email" nom="email" placeholder="Email"/>
                            <div class="flex justify-center"><x-boto tipus="submit" classe="botoPerfil w-full md:w-1/2" text="Actualitzar Dades"></x-boto></div>
                        </x-form>
                        <x-form method="post" action="/esborraUsuari" class="mt-2">
                            <div class="flex justify-center"><x-boto tipus="submit" classe="botoDelete w-full md:w-1/2" text="Esborrar el compte"></x-boto></div>
                        </x-form>
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
