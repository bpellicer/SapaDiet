@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('dataIncorrecte'))
    <x-alerta nom="error" missatge="{{ session('dataIncorrecte') }}"/>
@endif
@include("components.content.calendari")
<x-layout.footerAuth/>
