@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('alimentAfegit'))
    <x-alerta nom="success2" missatge="{{ session('alimentAfegit') }}"/>
@endif
@include("components.content.buscador")
<x-layout.footerAuth/>
