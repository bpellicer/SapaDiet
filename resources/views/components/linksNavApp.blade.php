@extends('partials.nav')

@section('botoNav')
    <div class="flex lg:hidden sm:mr-10">
        <button id="navbarBtn">
            <img class="toggle block" src="https://img.icons8.com/material-outlined/24/000000/menu--v1.png" width="30" height="30">
            <img class="toggle hidden" src="https://img.icons8.com/ios/50/000000/delete-sign--v1.png" width="20" height="20">
        </button>
    </div>
@endsection
@section('linksNavBar')
    <div class="toggle hidden navApp">
        <a href="#" class="linksApp">Gestió Dieta</a>
        <a href="#" class="linksApp mt-3">Cerca</a>
        <a href="#" class="linksApp mt-3">Llistes Compra</a>
        <a href="#" class="linksApp mt-3">Planificació</a>
        <a href="#" class="linksApp mt-3">Progrés</a>
        <a href="#" class="linksApp mt-3">Perfil</a>
        <a href="#" class="botoNavApp mt-3">Tanca Sessió</a>
    </div>
@endsection
