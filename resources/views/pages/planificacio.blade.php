@include('partials.headcontent')
<x-layout.navAuth/>

@if (session()->has('formulariInvalid'))
    <x-alerta nom="error" missatge="{{ session('formulariInvalid') }}"/>
@endif

@include('components.content.planificacio')
<x-layout.footerAuth/>
