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
    @auth
        <p>BENVINGUT/DA AL TEU PERFIL, {{auth()->user()->nom}}</p>
        <div class="container bg-green2">
            <form>
                <x-inputPerfil tipus="email" classe="inputClassic" id="email" nom="email" placeholder="Email"/>
                <x-inputPerfil tipus="text" classe="inputClassic" id="nom" nom="nom" placeholder="Nom"/>
                <x-inputPerfil tipus="text" classe="inputClassic" id="cognoms" nom="cognoms" placeholder="Cognoms"/>
                <input type="submit" value="Actualitzar Dades">
            </form>
        </div>
    @endauth
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
