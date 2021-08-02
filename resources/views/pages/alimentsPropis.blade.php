@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('alimentEsborrat'))
    <x-alerta nom="success2" missatge="{{ session('alimentEsborrat') }}"/>
@endif
@if (session()->has('alimentActualitzat'))
    <x-alerta nom="success2" missatge="{{ session('alimentActualitzat') }}"/>
@endif
@include("components.content.alimentsPropis")
<x-layout.footerAuth/>
