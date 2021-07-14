@if (session()->has('perfilEsborrat'))
    <x-alerta nom="success" missatge="{{ session('perfilEsborrat') }}"/>
@endif

<div class="flex flex-wrap mainPage">
    <div class="w-full flex">
        <div class="mx-auto">
            <img class="cuate" src="/imatges/homePageGuy.svg" alt="Un noi menjant una amanida">
            <h1 class="titolHomePage">Controlar el que
                menges mai havia
                sigut tan fàcil</h1>
            <p class="leading-relaxed lg:text-base px-10 md:px-20 lg:pt-5">Porta a terme un control de la teva dieta, calcula quantes kilocalories consumeixes al dia, crea llistes de la compra i molt més.</p>
            <div class="mx-auto px-10 md:px-20 pb-20 pt-2"><a href="" id = "btnInfo" class="botoEstandar inline-block px-5 py-2 text-center mt-5"><span class="iconify inline-block mr-2" data-inline="false" data-icon="bi:box-arrow-in-right"></span> Llegeix Més !</a></div>

        </div>
    </div>
</div>

<div class="contenidor" id="infoWeb">
    <div class="w-full text-center font-bold">
        <h1>Coneix l'aplicació!</h1>
    </div>
    <div class="contenidorCartes">
        <x-carta-home>
            <x-slot name="titol">Analitza la teva dieta</x-slot>
            <x-slot name="text">SapaDiet et mostra el teu progrés a través de gràfiques. Podràs dur a terme un control sobre la teva dieta i veure els resultats.</x-slot>
            <x-slot name="imatge">/imatges/buscador.png</x-slot>
        </x-carta-home>
        <x-carta-home>
            <x-slot name="titol">Escull el que vulguis</x-slot>
            <x-slot name="text">Podràs escollir els teus aliments preferits per a construir la teva dieta. Estan separats per categoría i amb informació nutricional!</x-slot>
            <x-slot name="imatge">/imatges/pensa.png</x-slot>
        </x-carta-home>
        <x-carta-home>
            <x-slot name="titol">Mira el calendari</x-slot>
            <x-slot name="text">Escull qualsevol dia del calendari i omple els àpats amb els aliments de la teva elecció. Pots planificar-te la dieta de la setmana o del mes!</x-slot>
            <x-slot name="imatge">/imatges/calendari.png</x-slot>
        </x-carta-home>
        <x-carta-home>
            <x-slot name="titol">Llistes de la compra</x-slot>
            <x-slot name="text">Crea llistes de la compra per quan vagis a comprar. Les podràs consultar quan vagis a comprar i et recordaran quins aliments agafar.</x-slot>
            <x-slot name="imatge">/imatges/llistacompra.png</x-slot>
        </x-carta-home>
    </div>
</div>
