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

/** Amaga el missatge de success després de 3 segons **/
window.setTimeout(function(){
    $("#success").stop().fadeOut('slow');
},3000);
