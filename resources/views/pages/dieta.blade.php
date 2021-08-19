@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('alimentEsborrat'))
    <x-alerta nom="success2" missatge="{{ session('alimentEsborrat') }}"/>
@endif
@include("components.content.dieta")
<script>
    let kcalConsumides = {!! json_encode($arrayNutrientsTotals[3]) !!};
    let kcalTotals = {!! json_encode($kcalTotals) !!}

    let cercle = $("#cercleBar");
    let radi = cercle.attr("r");
    let perimetre = 2 * Math.PI * radi;
    let pct = Math.round(kcalConsumides * 100 / kcalTotals);

    if(pct > 50 && pct < 100){
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
