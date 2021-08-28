@include('partials.headcontent')
<x-layout.navAuth/>

@error("imatge")
    <x-alerta nom="error2" missatge="Imatge incorrecta"/>
@enderror

@if (session()->has('perfilActualitzat'))
    <x-alerta nom="success2" missatge="{{ session('perfilActualitzat') }}"/>
@endif

@if (session()->has('imatgeNova'))
    <x-alerta nom="success2" missatge="{{ session('imatgeNova') }}"/>
@endif

@if (session()->has('perfilError'))
    <x-alerta nom="error2" missatge="{{ session('perfilError') }}"/>
@endif

@include('components.content.contentPerfil')

<x-layout.footerAuth/>
