@include('partials.headcontent')
<x-layout.navAuth/>

@if (session()->has('formulariInvalid'))
    <x-alerta nom="error" missatge="{{ session('formulariInvalid') }}"/>
@endif

@if (session()->has('novaPlanificacio'))
    <x-alerta nom="success" missatge="{{ session('novaPlanificacio') }}"/>
@endif

@if (session()->has('planificacioDefecte'))
    <x-alerta nom="error" missatge="{{ session('planificacioDefecte') }}"/>
@endif


@include('components.content.planificacio')
<x-layout.footerAuth/>
