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


$("#eliminaAliment").on("click", function(event){
    event.preventDefault();
    swal({
        title: "Estas segur que vols esborrar aquest aliment?",
        text: "No seràs capaç de tornar enrere!",
        icon:'warning',
        buttons:["Cancel·la","Si, esborra l'aliment"],
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

$("#cercaDiv").on("submit",function(e){
    e.preventDefault();
    $("#content").html("");
    let form = $(this);
    let nom = $("#buscadorNom").val();
    let categoria = $("#categoria").val();
    let url = form.attr('action');
    let comptador = 1;

    if(nom=="" && categoria =="-- Cap --"){
        setTimeout(function(){
            $("#content").append(`<p class="text-red-600 font-bold mt-4 text-xs sm:text-base">*Entra un nom o escull una categoria!</p>`);
        },100)
    }
    else{
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:url,
            data:{
                name:nom,
                cat:categoria
            },
            type:"post",
            dataType:"json",
            success:function(dades){
                console.log(dades);
                if(dades.length == 0){
                    setTimeout(function(){
                        $("#content").append(`<p class="text-red-600 font-bold mt-4 text-xs sm:text-base">*No s'ha trobat cap resultat!</p>`);
                    },100)
                }
                else{

                    $(dades).each(function(index){
                        let categoria = ["categoriaNom","urlImatge"];
                        categoria[0] = getCategoria(dades[index].categoria_id);
                        categoria[1] = getImatge(categoria[0]);
                        $("#content").append(`<div class="flex justify-center sm:inline-block"><div class="cartaAliment2" id="aliment`+comptador+`">
                                                <img src="`+categoria[1]+`" alt="" class="inline-block">
                                                <p class="font-bold mt-2">`+dades[index].nom+`</p>
                                                <p class="mt-2">Categoria: `+categoria[0]+`</p>
                                            </div></div>`);
                        $("#aliment"+comptador).on("click", function(e){
                            $(document.body).append(
                                `<div class="divExtern" id="divExtern2">
                                    <div class="divIntern2 w-64 xs:w-72 2xs:w-80 sm:w-100 md:w-100 h-110" id="divIntern2">
                                        <img src="/imatges/creu.png" class="creu" id="creu2">
                                        <h1 class="text-center font-bold md:text-3xl text-xl">`+dades[index].nom+` </h1>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 place-items-center">
                                            <div class="bg-white rounded-3xl border-2 border-black w-20 h-20 sm:w-28 sm:h-28 hidden sm:inline">
                                                <img src="`+categoria[1]+`" alt="" class="w-40">
                                            </div>
                                            <div class="col-span-2">
                                                <h2 class="font-semibold text-xs sm:text-sm mb-2">Informació nutricional 100 grams: </h2>
                                                <p class="mb-2 text-sm">Kilocalories: `+dades[index].kilocalories+` kcal.</p>
                                                <p class="mb-2 text-sm">Proteïnes: `+dades[index].proteines+` g.</p>
                                                <p class="mb-2 text-sm">Hidrats: `+dades[index].hidrats+` g.</p>
                                                <p class="mb-2 text-sm">Grasses: `+dades[index].grasses+` g.</p>
                                            </div>
                                        </div>
                                        <div>
                                            <form action="/" method="post" class="">
                                                <input type="hidden" name="_token" value="`+$('meta[name="csrf-token"]').attr("content")+`">
                                                <label for="data">Data</label>
                                                <input type="date" name="data" class="inputPerfil">
                                                <label for="grams" class="font-bold text-sm">Grams</label>
                                                <input type="text" name="grams" placeholder="Grams" class="inputPerfil">
                                                <label for="apat"> A on vols afegir l'aliment ? </label>
                                                <select name="apat" class="rounded-2xl w-8/12 sm:w-10/12 mt-2" style="padding:5.2px">
                                                    <option>Esmorzar</option>
                                                    <option>Mig Matí</option>
                                                    <option>Dinar</option>
                                                    <option>Berenar</option>
                                                    <option>Sopar</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>`
                            );

                            $(dades[index].nom);
                        });

                        ++comptador;
                    });
                }
            },
            error:function(){
                alert("error!");
            }
        });
    }
    function getCategoria(id){
        let categoriaNom = "";
        switch(id){
            case 1:
                categoriaNom = "Peixos";
            break;
            case 2:
                categoriaNom = "Carns";
            break;
            case 3:
                 categoriaNom = "Ous";
            break;
            case 4:
                 categoriaNom = "Verdures";
            break;
            case 5:
                 categoriaNom = "Llegums i Fruits Secs";
            break;
            case 6:
                 categoriaNom = "Làctics";
            break;
            case 7:
                 categoriaNom = "Fruites";
            break;
            case 8:
                 categoriaNom = "Mantequilles i olis";
            break;
            case 9:
                 categoriaNom = "Processats";
            break;
            case 10:
                 categoriaNom = "Begudes";
            break;
            case 11:
                 categoriaNom = "Cereals";
            break;
        }
        return categoriaNom;
    }
    function getImatge(categoria){
        let src ="";
        switch(categoria){
            case "Peixos":
                src = "/imatges/aliments/peix.png";
            break;
            case "Carns":
                src="/imatges/aliments/carn.png";
            break;
            case "Ous":
                src="/imatges/aliments/ou.png";
            break;
            case "Verdures":
                src="/imatges/aliments/verdura.png";
            break;
            case "Llegums i Fruits Secs":
                src="/imatges/aliments/cacahuet.png";
            break;
            case "Làctics":
                src="/imatges/aliments/formatge.png";
            break;
            case "Fruites":
                src="/imatges/aliments/poma.png";
            break;
            case "Mantequilles i olis":
                src="/imatges/aliments/olis.png";
            break;
            case "Processats":
                src="/imatges/aliments/processats.png";
            break;
            case "Begudes":
                src="/imatges/aliments/begudes.png";
            break;
            case "Cereals":
                src="/imatges/aliments/cereal.png";
            break;
        }
        return src;
    }
})
