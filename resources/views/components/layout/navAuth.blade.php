<x-layout.nav>
    <x-slot name="linksnav">
        <x-layout.linksnav navclass="navApp" btnclass="lg:hidden sm:mr-10">
            <div class="flex justify-center"><a href="/" class="linksApp ">Inici</a></div>
            <div class="flex justify-center"><a href="/calendari" class="linksApp mt-3 ">Gestió Dieta</a></div>
            <div class="flex justify-center"><a href="/cercador" class="linksApp mt-3 ">Cerca</a></div>
            <div class="flex justify-center"><a href="/" class="linksApp mt-3 ">Llistes Compra</a></div>
            <div class="flex justify-center"><a href="/planificacio" class="linksApp mt-3 ">Planificació</a></div>
            <div class="flex justify-center"><a href="/progres" class="linksApp mt-3 ">Progrés</a></div>
            <div class="flex justify-center"><a href="/perfil" class="linksApp mt-3 ">Perfil</a></div>
            <form action="/logout" method="post">@csrf<input type="submit" href="logout" class="botoNavApp mt-3" value="Tanca Sessió"></form>
        </x-layout.linksnav>
    </x-slot>
</x-layout.nav>
