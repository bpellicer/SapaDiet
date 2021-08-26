@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('errorLlista'))
    <x-alerta nom="error2" missatge="{{ session('errorLlista') }}"/>
@endif
@include('components.content.creaLlista')
<script>
    let accio = {!! json_encode($accio) !!};
    if(accio === "modificar"){
        let llista = {!! json_encode($llista) !!};
        $("#"+llista.classe).attr("checked","checked");
    }
</script>
<x-layout.footerAuth/>
