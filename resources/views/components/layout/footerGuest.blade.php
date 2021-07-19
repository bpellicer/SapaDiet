<x-layout.footer>
    <x-slot name="mapaweb">
        <x-mapaweb>
            <p class="mt-2"><a href="/" class="linkMapaWeb"> Inici </a></p>
            @auth
                <p class="mt-2"><a href="/perfil" class="linkMapaWeb"> SapaDiet </a></p>
            @endauth
            @guest
                <p class="mt-2"><a href="/login" class="linkMapaWeb"> Login </a></p>
                <p class="mt-2"><a href="/registre" class="linkMapaWeb"> Registra't </a></p>
            @endguest

        </x-mapaweb>
    </x-slot>
</x-layout.footer>
