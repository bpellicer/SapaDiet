@include('partials.headcontent')
<x-layout.navAuth/>
@include('components.content.informacioAliment')
<script>
    $(document).ready(function(){
    let ara = new Date();
    let dia = ("0" + ara.getDate()).slice(-2);
    let mes = ("0" + (ara.getMonth() + 1)).slice(-2);

    let avui = ara.getFullYear()+"-"+(mes)+"-"+(dia) ;
    $("#dataInput").val(avui);
});
</script>

<x-layout.footerAuth/>
