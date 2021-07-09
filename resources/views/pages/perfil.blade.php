@include('partials.headcontent')
<x-layout.navAuth/>

@if (session()->has('perfilActualitzat'))
    <x-alerta nom="success" missatge="{{ session('perfilActualitzat') }}"/>
@endif

<x-contentPerfil/>

<x-layout.footerAuth/>
