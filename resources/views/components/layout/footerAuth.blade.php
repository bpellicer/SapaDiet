<x-layout.footer>
    <x-slot name="mapaweb">
        <x-mapaweb>
            <div class="flex flex-wrap">
                <div class="w-full sm:w-1/3">
                    <x-columnaMapaWeb name="Gestionar Dieta" href="/calendari"/>
                    <x-columnaMapaWeb name="Cerca" href="/cercador"/>
                </div>
                <div class="w-full sm:w-1/3">
                    <x-columnaMapaWeb name="Llistes Compra" href="/llistes_compra"/>
                    <x-columnaMapaWeb name="Planificació" href="/planificacio"/>
                </div>
                <div class="w-full sm:w-1/3">
                    <x-columnaMapaWeb name="Progrés" href="/progres"/>
                    <x-columnaMapaWeb name="Perfil" href="/perfil"/>
                </div>
            </div>
        </x-mapaweb>
    </x-slot>
</x-layout.footer>
