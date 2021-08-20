@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('alimentEsborrat'))
    <x-alerta nom="success2" missatge="{{ session('alimentEsborrat') }}"/>
@endif
@include("components.content.dieta")
<script>
    /** Actualitza el gràfic de la barra de progrés **/
    let kcalConsumides = {!! json_encode($arrayNutrientsTotals[3]) !!};
    let kcalTotals = {!! json_encode($kcalTotals) !!}

    let cercle = $("#cercleBar");
    let radi = cercle.attr("r");
    let perimetre = 2 * Math.PI * radi;
    /** Calcula el percentatge del total de la barra de progrés **/
    let pct = Math.round(kcalConsumides * 100 / kcalTotals);

    /** Si el pct és superior a 50 i inferior a 100 s'aplica la formula següent **/
    if(pct > 50 && pct < 100){
        /** Com que el radi del cercle no és 90 (Amb 90 graus és fa diferent) sinó 60, he hagut de trobar quan el cercle està al 100% i quan al 0.
         * Si multiplico el perímetre per 0.5, obtinc el 100 % del cercle complet, i si el multiplico per 1.5 tinc el 0%.
         * Així que partint d'1 que és el 50%, si al percentatge de les kcal li restes 50 i divideixes entre 100, tens el nombre decimal
         * correcte amb el que has de multiplicar el perímetre.
         *
         * EXEMPLE: pct = 70%. (1 - (70-50)/100) => 0.8
         * Com que 0.5 és el 100% i 1 el 50%. Si vas restant 0.1 a 1 tens el següent: 1(50%) - 0.1(10%) = 0.9(60%) => 0.8(70%) => ...
         * Quan el pct és inferior o igual a 50%
         *
         * EXEMPLE2: pct = 45%. (1 - (45-50)/100) => 1-(-0.05) = 1.05. Aplicant el mateix de dalt: 1(50%) + 0.1(10%) = 1.10(40%) => 1.05(45%).
         *
         * Després ho multipliques pel perímetre i tens l'àrea que s'ha d'omplir del cercle.
         * **/
        let percentatgeSuperior = (1 - (pct-50)/100) * perimetre;
        cercle.css({
            strokeDashoffset: percentatgeSuperior
        });
    }
    else if (pct <=50){
        let percentatgeInferior = (1 - (pct-50)/100) * perimetre;
        cercle.css({
            strokeDashoffset: percentatgeInferior
        });
    }
    else{
        cercle.css({
            strokeDashoffset: 0.5 * perimetre
        });
    }

    $("#percentatge").text(pct+" %");
</script>
<x-layout.footerAuth/>
