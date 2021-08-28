@include('partials.headcontent')
<x-layout.navAuth/>
@include('components.content.informacioAliment')

@if (session()->has('alimentError'))
    <x-alerta nom="error2" missatge="{{ session('alimentError') }}"/>
@endif

@if (session()->has('errorId'))
    <x-alerta nom="error2" missatge="{{ session('errorId') }}"/>
@endif

@error('id')
    <x-alerta nom="error2" missatge="{{ucfirst($message)}}"/>
@enderror

<script>
    /** Quan el document es carregui posa la data d'avui a l'input #dataInput **/
    $(document).ready(function(){
    let ara = new Date();
    let dia = ("0" + ara.getDate()).slice(-2);
    let mes = ("0" + (ara.getMonth() + 1)).slice(-2);

    let avui = ara.getFullYear()+"-"+(mes)+"-"+(dia) ;
    $("#dataInput").val(avui);
});
</script>
<x-layout.footerAuth/>
