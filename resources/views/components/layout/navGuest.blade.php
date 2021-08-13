<x-layout.nav>
    <x-slot name="linksnav">
        <x-layout.linksnav navclass="navHome" btnclass="sm:hidden">
            <a href="/" class="linksHome">Inici</a>
            @auth
                <a href="/perfil" class="linksHome mt-3">SapaDiet</a>
                <form action="logout" method="post">@csrf<input type="submit" href="logout" class="botoNavHome mt-3" value="Tanca Sessió"></form>
            @endauth
            @guest
                <a href="/login" class="linksHome mt-3">Login</a>
                <a href="/registre" class="botoNavHome mt-3">Registra't</a>
            @endguest
        </x-layout.linksnav>
    </x-slot>
</x-layout.nav>
