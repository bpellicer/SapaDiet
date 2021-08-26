@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('errorAccio'))
    <x-alerta nom="error2" missatge="{{ session('errorAccio') }}"/>
@endif
@if (session()->has('errorLlista'))
    <x-alerta nom="error2" missatge="{{ session('errorLlista') }}"/>
@endif
@if (session()->has('errorEsborrar'))
    <x-alerta nom="error2" missatge="{{ session('errorEsborrar') }}"/>
@endif
@if (session()->has('llistaEsborrada'))
    <x-alerta nom="success2" missatge="{{ session('llistaEsborrada') }}"/>
@endif

@if (session()->has('llistaCreada'))
    <x-alerta nom="success2" missatge="{{ session('llistaCreada') }}"/>
@endif

@if (session()->has('llistaModificada'))
    <x-alerta nom="success2" missatge="{{ session('llistaModificada') }}"/>
@endif

@include('components.content.llistesCompra')

<x-layout.footerAuth/>
