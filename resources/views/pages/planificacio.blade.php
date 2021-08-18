@include('partials.headcontent')
<x-layout.navAuth/>

@if (session()->has('formulariInvalid'))
    <x-alerta nom="error2" missatge="{{ session('formulariInvalid') }}"/>
@endif

@if (session()->has('novaPlanificacio'))
    <x-alerta nom="success2" missatge="{{ session('novaPlanificacio') }}"/>
@endif

@if (session()->has('planificacioDefecte'))
    <x-alerta nom="error2" missatge="{{ session('planificacioDefecte') }}"/>
@endif


@include('components.content.planificacio')

<script>
    /** Conversió de dades PHP a dades JSON **/
    let planificacio = {!! json_encode($planificacio) !!};
    let aliments = {!! json_encode($aliments) !!};

    /** El select amb id objectiu selecciona l'opció que l´usuari té guardada a la BDD **/
    $("#objectiu").val(planificacio.objectius);
    /** El selcet amb id esport selecciona l'opció que l'usuari té guardada a la BDD **/
    $("#esport").val(planificacio.esport);
    /** El nombre d'àpats de la planificació escull el radio button corresponent **/
    $("#apat"+planificacio.nombre_apats).prop("checked",true);

    /** For que recorre l'array dels aliments seleccionats i amb l'ajuda de jQuery checkeja aquells que l'Usuari té a la BDD **/
    for(let i=0; i<aliments.length; i++){
        $("#"+aliments[i]).attr("checked","checked");
    }
</script>

<x-layout.footerAuth/>
