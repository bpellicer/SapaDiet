import './bootstrap';

"use strict";

/*** Afegeix i elimina la classe dels elements toggle amb la funció toggleClass ***/
$("#navbarBtn").on("click", function(){
    $(".toggle").toggleClass("hidden");
});


/*** Fa scroll cap al div de Info Web sempre i quan a la pantalla no aparegui ja el div d'info web (Pantalles ultra grans o zoom molt petit) ***/
$("#btnInfo").on("click", function(e){
    e.preventDefault();
    $("html,body").animate({
        scrollTop: $("#infoWeb").offset().top
    },'slow');
});



/*** Amaga i ensenya les contrasenyes ***/
$("#btnPass").on("click", function(e){
    if($(this).is(":checked")){
        $(".contrasenya").attr('type','text');
        $("#btnPass").attr("src","/imatges/invisible.svg");
        $("#labelPass").text("Amaga contrasenya");
    }
    else{
        $(".contrasenya").attr('type','password');
        $("#btnPass").attr("src","/imatges/eye.svg");
        $("#labelPass").text("Mostra contrasenya");
    }
});

/**
 * Event Onclick que s'activa al premer el botó d'eliminar el compte. L'event submit del form s'atura i es demana una confirmació
 * en base a una JS promise. Si es compleix, es fa submit al form, altrament retorna fals (Llibreria Sweet Alert per les alertes estilitzades)
 */
$("#eliminaPerfil").on("click", function(event){
    event.preventDefault();
    swal({
        title: "Estas segur que vols esborrar el teu compte?",
        text: "No seràs capaç de recuperar el teu usuari!",
        icon:'warning',
        buttons:['Cancel·la','Si, esborra el meu compte'],
        closeOnClickOutside: false,
        dangerMode:true
    }).then((esborra) => {
        if(esborra){
            $("#eliminaForm").submit();
        }
        else return false;
    });
});


/** Amaga el missatge de success després de 3 segons **/
window.setTimeout(function(){
    $("#success").stop().fadeOut('slow');
    $('#error').stop().fadeOut('slow');
    $('#success2').stop().fadeOut('slow');
},3000);


$("#imatgePerfil").on("click", function(){
    $("#divIntern").show();
});


$("#creu").on("click",function(){
    $("#divIntern").hide();
});


$('#divIntern2').fadeIn('slow');

$("#creu2").on("click",function(){
    $("#divIntern2").hide();
    $("#divExtern2").hide();
});
