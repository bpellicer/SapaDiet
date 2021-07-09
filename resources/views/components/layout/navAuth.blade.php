<x-layout.nav>
    <x-slot name="linksnav">
        <x-layout.linksnav navclass="navApp" btnclass="lg:hidden sm:mr-10">
            <a href="#" class="linksApp">Gestió Dieta</a>
            <a href="#" class="linksApp mt-3">Cerca</a>
            <a href="#" class="linksApp mt-3">Llistes Compra</a>
            <a href="#" class="linksApp mt-3">Planificació</a>
            <a href="#" class="linksApp mt-3">Progrés</a>
            <a href="#" class="linksApp mt-3">Perfil</a>
            <form action="logout" method="post">@csrf<input type="submit" href="logout" class="botoNavApp mt-3" value="Tanca Sessió"></form>
        </x-layout.linksnav>
    </x-slot>
</x-layout.nav>
