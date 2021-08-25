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
        $("#labelPass").text("Amaga contrasenya");
    }
    else{
        $(".contrasenya").attr('type','password');
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
        title: "Estàs segur que vols esborrar el teu compte?",
        text: "No seràs capaç de recuperar el teu usuari!",
        icon:'warning',
        buttons:['Cancel·la','Sí, esborra el meu compte'],
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
        title: "Estàs segur que vols esborrar aquest aliment?",
        text: "No seràs capaç de tornar enrere!",
        icon:'warning',
        buttons:["Cancel·la","Sí, esborra l'aliment"],
        closeOnClickOutside: false,
        dangerMode:true
    }).then((esborra) => {
        if(esborra){
            $("#eliminaForm").submit();
        }
        else return false;
    });
});



$("#eliminaDia").on("click", function(event){
    event.preventDefault();
    swal({
        title: "Estàs segur que vols esborrar la informació del dia?",
        text: "No seràs capaç de tornar enrere!",
        icon:'warning',
        buttons:["Cancel·la","Sí, esborra el dia"],
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
    $('#error2').stop().fadeOut('slow');
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
                            let info = `<div class="divExtern" id="divExtern2">
                            <div class="divIntern2 w-64 xs:w-72 2xs:w-80 sm:w-100 md:w-100 h-110" id="divIntern2">
                                <img src="/imatges/creu.png" class="creu" id="creu2" onclick="amaga()">
                                <h1 class="text-center font-bold md:text-xl text-base">`+dades[index].nom+` </h1>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 place-items-center">
                                    <div class="bg-white rounded-3xl border-2 border-black w-20 h-20 sm:w-28 sm:h-28 hidden sm:inline">
                                        <img src="`+categoria[1]+`" alt="" class="w-40">
                                    </div>
                                    <div class="col-span-2">
                                        <h2 class="font-semibold text-xs sm:text-sm mb-2">Informació nutricional <span id="infoGrams">100 grams</span>: </h2>
                                        <div class="grid grid-cols-2 gap-1">
                                            <div>
                                                <p class="mb-2 text-sm">Kilocalories:</p>
                                                <p class="mb-2 text-sm">Proteïnes:</p>
                                                <p class="mb-2 text-sm">Hidrats:</p>
                                                <p class="mb-2 text-sm">Greixos:</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="mb-2 text-sm" id="infoKcal">`+dades[index].kilocalories+` kcal.</p>
                                                <p class="mb-2 text-sm" id="infoProte">`+dades[index].proteines+` g.</p>
                                                <p class="mb-2 text-sm" id="infoHidrats">`+dades[index].hidrats+` g.</p>
                                                <p class="mb-2 text-sm" id="infoGreix">`+dades[index].greixos+` g.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="xs:px-2 py-1 mt-4">
                                <h2 class="font-bold text-xs sm:text-sm mb-4">Afegeix l'aliment a un àpat diari</h2>
                                    <form action="/afegeixAlimentDieta" method="post" class="">
                                        <input type="hidden" name="tipusAliment" value="bdd">
                                        <input type="hidden" name="_token" value="`+$('meta[name="csrf-token"]').attr("content")+`">
                                        <input type="hidden" name="alimentNom" value="`+dades[index].nom+`">
                                        <input type="hidden" name="alimentId" value="`+dades[index].id+`">
                                        <label for="data" class="text-xs mb-2">Data</label>
                                        <input type="date" name="data" class="p-1 w-full mb-2 rounded-md" id="dataInput">
                                        <label for="apat" class="text-xs mb-2">Àpat</label>
                                        <select name="apat" class="text-sm rounded-md w-full mb-2" style="padding:5.2px">
                                            <option>Esmorzar</option>
                                            <option>Mig Matí</option>
                                            <option>Dinar</option>
                                            <option>Berenar</option>
                                            <option>Sopar</option>
                                        </select>
                                        <label for="grams" class="font-bold text-xs">Grams</label>
                                        <input type="number" name="grams" placeholder="Grams" class="inputPerfil" id="inputGrams" min=0 step="0.001">
                                        <div class="flex justify-center mt-4">
                                            <input type="submit" value="Afegeix" class="botoPerfil w-full md:w-80 mt-2">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script id="scriptData">
                            $("#inputGrams").on("input", function(){

                                if(!isNaN($(this).val()) && $(this).val() >= 0 && $(this).val().length < 5 ){
                                    let kcal = (`+dades[index].kilocalories +`*($(this).val()/100)).toFixed(2);
                                    let pro = (`+dades[index].proteines +`*($(this).val()/100)).toFixed(2);
                                    let hid = (`+dades[index].hidrats +`*($(this).val()/100)).toFixed(2);
                                    let gre = (`+dades[index].greixos +`*($(this).val()/100)).toFixed(2);

                                    /** Canvia els valors de la informació de l'Aliment per a que l'Usuari ho entengui tot millor **/
                                    if($(this).val() != 1){
                                        if($(this).val() == "" || $(this).val() == 0){
                                            $("#infoGrams").text("0 grams");
                                        }
                                        else{
                                            console.log(parseFloat($(this).val()));
                                            $("#infoGrams") .text(parseFloat($(this).val()) + " grams");
                                        }
                                    }
                                    else{
                                        $("#infoGrams").text(parseFloat($(this).val()) + " gram");
                                    }

                                    $("#infoKcal").text(kcal +" kcal.");
                                    $("#infoProte").text(pro +" g.");
                                    $("#infoHidrats").text(hid +" g.");
                                    $("#infoGreix").text(gre +" g.");
                                }
                            });

                            $("#divIntern2").ready(function(){
                                let ara = new Date();
                                let dia = ("0" + ara.getDate()).slice(-2);
                                let mes = ("0" + (ara.getMonth() + 1)).slice(-2);

                                let avui = ara.getFullYear()+"-"+(mes)+"-"+(dia) ;
                                $("#dataInput").val(avui);
                            });
                        </script>`;

                            $(info).insertBefore(".footer");
                        });
                        ++comptador;
                    });

            }
        },
            error:function(){
               alert("Error");
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
                src="/imatges/aliments/llegums.png";
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
});

$("#showImc").on("click",function(){
    $(this).toggleClass('rota');
    let info = `<div><table class="table-fixed"><thead><tr class="bg-green5"><th class=" w-96">IMC</th><th class=" w-96">Classificació</th></tr></thead>
                <tbody><tr><td><p> < 16.00</p></td><td><p>Pes baix: Primor severa</p></td></tr><tr><td><p> 16.00 - 16.99</p></td><td><p>Pes baix: Primor moderada</p></td></tr><tr><td><p> 17.00 - 18.49</p></td><td><p>Pes baix: Primor acceptable</p></td></tr><tr><td><p> 18.50 - 24.99</p></td>
                <td><p>Pes normal</p></td></tr><tr><td><p> 25.00 - 29.99</p></td><td><p>Sobrepès</p></td></tr><tr><td><p> 30.00 - 34.99</p></td><td><p>Obesitat: Tipus I</p></td></tr><tr><td><p> 35.00 - 40.00</p></td><td><p>Obesitat: Tipus II</p></td></tr>
                <tr><td><p> > 40.00</p></td><td><p>Obesitat: Tipus III</p></td></tr></tbody></table></div>`

    if($(this).hasClass('rota')){
        $(info).hide().appendTo("#infoImc").show("slow");
    }
    else{
        $("#infoImc").html("");
    }
});

$("#contra1").on("focus",function(){
    $(".infoPass").show(500);
});
$("#contra1").on("blur",function(){
    $(".infoPass").hide(500);
});

$("#addProducte").on("click",function(){
    alert("yes");
   /*  $("#infoProducte").append("<p>yes</p>"); */
});
