@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('dataIncorrecte'))
    <x-alerta nom="error2" missatge="{{ session('dataIncorrecte') }}"/>
@endif

@if (session()->has('diaEsborrat'))
    <x-alerta nom="success2" missatge="{{ session('diaEsborrat') }}"/>
@endif

@include("components.content.calendari")
<x-layout.footerAuth/>
