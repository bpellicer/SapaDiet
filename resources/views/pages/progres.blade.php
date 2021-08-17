@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('pesAlturaError'))
    <x-alerta nom="error2" missatge="{{ session('pesAlturaError') }}"/>
@endif
@if (session()->has('pesAlturaUpdate'))
    <x-alerta nom="success2" missatge="{{ session('pesAlturaUpdate') }}"/>
@endif
@include('components.content.progres')
<x-layout.footerAuth/>
