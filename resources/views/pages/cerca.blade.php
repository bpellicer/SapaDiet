@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('alimentCreat'))
    <x-alerta nom="success" missatge="{{ session('alimentCreat') }}"/>
@endif
<x-content.opcionsCerca/>
<x-layout.footerAuth/>
