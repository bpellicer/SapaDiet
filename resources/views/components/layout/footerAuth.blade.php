<x-layout.footer>
    <x-slot name="mapaweb">
        <x-mapaweb>
            <div class="flex flex-wrap">
                <div class="w-full sm:w-1/3">
                    <x-columnaMapaWeb name="Gestionar Dieta" href=""/>
                    <x-columnaMapaWeb name="Cerca" href="cerca"/>
                </div>
                <div class="w-full sm:w-1/3">
                    <x-columnaMapaWeb name="Llistes Compra" href=""/>
                    <x-columnaMapaWeb name="Planificació" href="planificacio"/>
                </div>
                <div class="w-full sm:w-1/3">
                    <x-columnaMapaWeb name="Progrés" href=""/>
                    <x-columnaMapaWeb name="Perfil" href="perfil"/>
                </div>
            </div>
        </x-mapaweb>
    </x-slot>
</x-layout.footer>
