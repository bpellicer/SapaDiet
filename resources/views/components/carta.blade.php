
@extends("components.homePage")

@section("cartes")
    <div class="contenidorCarta">
        <div class="cartaInfo">
            @yield("infoCarta1")
        </div>
    </div>
    <div class="contenidorCarta">
        <div class="cartaInfo">
            @yield("infoCarta2")
        </div>
    </div>
    <div class="contenidorCarta">
        <div class="cartaInfo">
            @yield("infoCarta3")
        </div>
    </div>
    <div class="contenidorCarta">
        <div class="cartaInfo">
            @yield("infoCarta4")
        </div>
    </div>
@endsection

