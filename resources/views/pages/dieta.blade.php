@include('partials.headcontent')
<x-layout.navAuth/>
@include("components.content.dieta")
<script>
    let cercle = $("#cercleBar");
    let radi = cercle.attr("r");
    let perimetre = 2 * Math.PI * radi;
    let pct = 75;
    let percentatgeSuperior = (1 - (pct-50)/100) * perimetre;
    let percentatgeInferior = (1 - (pct-50)/100) * perimetre;

    cercle.css({
        strokeDashoffset: percentatgeSuperior
    });

    $("#percentatge").text(pct+" %");
</script>
<x-layout.footerAuth/>
