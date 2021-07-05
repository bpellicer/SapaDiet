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
<div class="contenidor">
    <div class="subcontenidor">
        <div class="contenidor-login">
            <div class="imatge-login" style="background-image: url(/imatges/login.jpg)"></div>
            <div class="subcontenidor-login">
                <h3 class="pt-4 text-2xl text-center font-bold">Inicia la sessió</h3>
                <x-form method="post" class="px-8 pt-6 pb-8">
                    <x-input tipus="email" nom="email" placeholder="Email"/>
                    <x-input tipus="password" nom="contrasenya" placeholder="Contrasenya"/>
                    <div class="text-center">
                        <x-boto tipus="submit" classe="botoForm w-full" text="Entra"/>
                    </div>
                    <div class=" mt-4">
                        <a href="recuperacio" class="text-sm hover:text-green1">Has oblidat la contrasenya?</a>
                    </div>
                    <div class=" mt-4">
                        <a href="registre" class="text-sm hover:text-green1">No tens cap compte? Registra't</a>
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
