@extends('partials.nav')

@section('botoNav')
    <div class="flex sm:hidden">
        <button id="navbarBtn">
            <img class="toggle block" src="https://img.icons8.com/material-outlined/24/000000/menu--v1.png" width="30" height="30">
            <img class="toggle hidden" src="https://img.icons8.com/ios/50/000000/delete-sign--v1.png" width="20" height="20">
        </button>
    </div>
@endsection

@section('linksNavBar')
    <div class="toggle navHome hidden">
        <a href="#" class="linksHome">Inici</a>
        <a href="#" class="linksHome mt-3">Login</a>
        <a href="#" class="botoNavHome mt-3">Registra't</a>
    </div>
@endsection
