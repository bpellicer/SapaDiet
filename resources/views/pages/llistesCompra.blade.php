@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('errorAccio'))
    <x-alerta nom="error2" missatge="{{ session('errorAccio') }}"/>
@endif
@if (session()->has('errorLlista'))
    <x-alerta nom="error2" missatge="{{ session('errorLlista') }}"/>
@endif
@include('components.content.llistesCompra')
<x-layout.footerAuth/>
