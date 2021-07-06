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
        <div class="contenidor-registre">
            <div class="subcontenidor-registre">
                <h3 class="pt-4 text-2xl text-center font-bold">Crea un compte!</h3>
                <x-form method="post" action="/registre" class="px-8 pt-6 pb-8 form">
                    <x-input tipus="text" classe="inputClassic" nom="nom" placeholder="Nom"/>
                    <x-input tipus="text" classe="inputClassic" nom="cognoms" placeholder="Cognoms" />
                    <x-input tipus="email" classe="inputClassic" nom="email" placeholder="Email" />
                    <x-input tipus="password" classe="inputClassic contrasenya" nom="contrasenya" placeholder="Contrasenya"/>
                    <x-input tipus="password" classe="inputClassic contrasenya" nom="contrasenya" placeholder="Repeteix Contrasenya" />
                    <input id="btnPass" type="checkbox" name="checkbox" class="mr-1 mb-4"><label for="checkbox" id="labelPass">Mostra contrasenya</label>
                    <div class="text-center">
                        <x-boto tipus="submit" classe="botoForm w-full" text="Registra't"/>
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
            <p class="mt-2"><a href="/login" class="linkMapaWeb"> Login </a></p>
            <p class="mt-2"><a href="/registre" class="linkMapaWeb"> Registra't </a></p>
        </x-mapaweb>
    </x-slot>
</x-footer>
