@include('partials.headcontent')
<x-nav>
    <x-slot name="linksnav">
        <x-linksnav navclass="navHome" btnclass="sm:hidden">
            <a href="/" class="linksHome">Inici</a>
            <a href="login" class="linksHome mt-3">Login</a>
            <a href="registre" class="botoNavHome mt-3">Registra't</a>
        </x-linksnav>
    </x-slot>
</x-nav>
<div class="container mx-auto ">
    <div class="flex justify-center px-10 my-12">
        <div class="w-full flex sm:justify-center">
            <div class="w-full bg-green4 lg:w-2/3 p-5 rounded-3xl border-2 border-black">
                <h3 class="pt-4 text-2xl text-center font-bold">Inicia la sessió</h3>
                <x-form method="post" class="px-8 pt-6 pb-8">
                    <x-input tipus="email" nom="email" placeholder="Email"/>
                    <x-input tipus="password" nom="contrasenya" placeholder="Contrasenya"/>
                    <div class="text-center">
                        <x-boto tipus="submit" classe="botoNavHome w-full" text="Entra"/>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
</div>
<x-footer>
    <x-slot name="mapaweb">
        <x-mapaweb>
            <p class="mt-2"><a href="/" class="linkMapaWeb"> Inici </a></p>
            <p class="mt-2"><a href="login" class="linkMapaWeb"> Login </a></p>
            <p class="mt-2"><a href="registre" class="linkMapaWeb"> Registra't </a></p>
        </x-mapaweb>
    </x-slot>
</x-footer>
