@include('partials.headcontent')
<x-layout.navAuth/>
@include("components.content.dieta")
<script>
    let kcalTotals = {!! json_encode($arrayNutrientsTotals[3]) !!};
    let cercle = $("#cercleBar");
    let radi = cercle.attr("r");
    let perimetre = 2 * Math.PI * radi;
    let pct = Math.round(kcalTotals * 100 / 2850);

    if(pct > 50){
        let percentatgeSuperior = (1 - (pct-50)/100) * perimetre;
        cercle.css({
            strokeDashoffset: percentatgeSuperior
        });
    }
    else{
        let percentatgeInferior = (1 - (pct-50)/100) * perimetre;
        cercle.css({
            strokeDashoffset: percentatgeInferior
        });
    }
    $("#percentatge").text(pct+" %");
</script>
<x-layout.footerAuth/>
