@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('errorLlista'))
    <x-alerta nom="error2" missatge="{{ session('errorLlista') }}"/>
@endif
@include('components.content.creaLlista')
<x-layout.footerAuth/>
