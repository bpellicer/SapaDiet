@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('alimentEsborrat'))
    <x-alerta nom="success2" missatge="{{ session('alimentEsborrat') }}"/>
@endif
@include("components.content.alimentsPropis")
<x-layout.footerAuth/>
