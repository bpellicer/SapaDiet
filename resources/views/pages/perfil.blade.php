@include('partials.headcontent')
<x-layout.navAuth/>

@if (session()->has('perfilActualitzat'))
    <x-alerta nom="success" missatge="{{ session('perfilActualitzat') }}"/>
@endif


@include('components.content.contentPerfil')

<x-layout.footerAuth/>
