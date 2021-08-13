<x-layout.nav>
    <x-slot name="linksnav">
        <x-layout.linksnav navclass="navHome" btnclass="sm:hidden">
            <div class="flex justify-center"><a href="/" class="linksHome w-10">Inici</a></div>
            @auth
                <div class="flex justify-center"><a href="/perfil" class="linksHome mt-3 w-10">SapaDiet</a></div>
                <form action="logout" method="post">@csrf<input type="submit" href="logout" class="botoNavHome mt-3" value="Tanca Sessió"></form>
            @endauth
            @guest
                <div class="flex justify-center"><a href="/login" class="linksHome mt-3 w-10">Login</a></div>
                <a href="/registre" class="botoNavHome mt-3">Registra't</a>
            @endguest
        </x-layout.linksnav>
    </x-slot>
</x-layout.nav>
