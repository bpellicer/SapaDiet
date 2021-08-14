@include('partials.headcontent')
<x-layout.navGuest/>

@if (session()->has('usuariCreat'))
    <x-alerta nom="success2" missatge="{{ session('usuariCreat') }}"/>
@endif

@if (session()->has('missatge'))
    <x-alerta nom="success" missatge="{{ session('missatge') }}"/>
@endif

@include("components.content.login")
<x-layout.footerGuest/>
