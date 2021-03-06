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

/**
 * Event Onclick que s'activa al premer el botó d'eliminar Aliment. L'event submit del form s'atura i es demana una confirmació
 * en base a una JS promise. Si es compleix, es fa submit al form, altrament retorna fals (Llibreria Sweet Alert per les alertes estilitzades)
 */
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


/**
 * Event Onclick que s'activa al premer el botó d'eliminar el dia. L'event submit del form s'atura i es demana una confirmació
 * en base a una JS promise. Si es compleix, es fa submit al form, altrament retorna fals (Llibreria Sweet Alert per les alertes estilitzades)
 */
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

/** Event que ensenya el divIntern quan es clica a la Imatge de perfil **/
$("#imatgePerfil").on("click", function(){
    $("#divIntern").show();
});

/** Event que amaga el divIntern quan es clica a la creu **/
$("#creu").on("click",function(){
    $("#divIntern").hide();
});

/** Fa que aparegui el divIntern2 amb un fadeIn slow **/
$('#divIntern2').fadeIn('slow');

/** Event que amaga el divIntern2 i el divIntern2 **/
$("#creu2").on("click",function(){
    $("#divIntern2").hide();
    $("#divExtern2").hide();
});

/** Consulta AJAX que s'encarrega d'enviar una petició al servidor per obtenir els Aliments de la BDD **/
$("#cercaDiv").on("submit",function(e){
    e.preventDefault();
    /** Cada vegada que fa submit al form, s'esborra el contingut del div content **/
    $("#content").html("");

    /** Variables **/
    let form = $(this);
    let nom = $("#buscadorNom").val();
    let categoria = $("#categoria").val();
    let url = form.attr('action');
    /** Comptador per controlar els ID's dels divs dels Aliments **/
    let comptador = 1;

    /** Si el nom està buit i la categoria és la per defecte, es mostra un missatge dins del div content amb un Timeout de 100ms
     *  perquè aparegui més lent que sent instantani **/
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
                    /**  Si no troba cap resultat a la BDD mostra un missatge d'error al div de content **/
                    setTimeout(function(){
                        $("#content").append(`<p class="text-red-600 font-bold mt-4 text-xs sm:text-base">*No s'ha trobat cap resultat!</p>`);
                    },100)
                }
                else{
                    $(dades).each(function(index){
                        /** Variable auxiliar que conté el nom de la Categoria i la seva Imatge **/
                        let categoria = ["categoriaNom","urlImatge"];
                        categoria[0] = getCategoria(dades[index].categoria_id);
                        categoria[1] = getImatge(categoria[0]);

                        /**  Afegeix al div content un div per cada Aliment que es troba amb el nom i la imatge **/
                        $("#content").append(`<div class="flex justify-center sm:inline-block"><div class="cartaAliment2" id="aliment`+comptador+`">
                                                <img src="`+categoria[1]+`" alt="" class="inline-block">
                                                <p class="font-bold mt-2">`+dades[index].nom+`</p>
                                                <p class="mt-2">Categoria: `+categoria[0]+`</p>
                                            </div></div>`);

                        /** Per cada #alimentComptador, es genera un event que quan es clica al div mostra tota la informació de l'Aliment
                         *  dins d'un div centrat a la pantalla, el qual consta d'un petit formulari per afegir aquest Aliment a una data i
                         *  a un àpat en específic. També genera un script tag per a controlar l'event dels grams i així canviar la informació
                         *  nutricional de l'Aliment cada vegada que l'input dels grams es canvia. Finalment posa la data del dia d'avui a
                         *  l'input DATE **/
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
    /**
     * Funció que retorna el nom de la Categoria de l'Aliment
     * @param {*} id    Conté l'id de la categoria
     */
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

    /**
     * Funció que retorna la imatge de la categoria
     * @param {*} categoria     Conté el nom de la categoria
     *
     */
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

/** Event que gira la imatge de #showImc utilitzant el toggleClass i la classe rota. Si la imatge té la classe rota, afegeix la taula
 *  de l'IMC al div d'infoIMC de manera lenta. Altrament esborra el contingut del div.
 */
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

/** Event Focus que ensenya el div d'infoPass amb la informació per a crear una contrasenya segura **/
$("#contra1").on("focus",function(){
    $(".infoPass").show(500);
});

/** Event Blur que amaga el div d'infoPass quan deixa de tenir el focus l'input de contra1 **/
$("#contra1").on("blur",function(){
    $(".infoPass").hide(500);
});

/** Event Click que s'activa quan cliques a la imatge d'addProducte i afegeix un nouProducte dins del divProductes **/
$("#addProducte").on("click",function(){
    let nouProducte = ` <div class="grid sm:grid-cols-2 sm:col-span-2 border-2 border-black mx-3 sm:mx-10 mb-6 infoProducte" id="infoProducte">
                            <div><h2 class="text-sm sm:text-base md:text-lg font-bold my-3">Quantitat</h2></div>
                            <div id="divQuantitat" class="align-middle flex sm:mr-1">
                                <input type="number"placeholder="0" name="quantitatsProducte[]" id="quantitatProducte" class="w-20 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow my-2 mx-auto">
                            </div>

                            <div><h2 class="text-sm sm:text-base md:text-lg font-bold my-3">Nom</h2></div>
                            <div id="divInput" class="align-middle flex sm:mr-1">
                                <input type="text" placeholder="Nom" name="nomsProducte[]" id="nomProducte" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow w-40 2xs:w-60 my-2 mx-auto">
                            </div>
                        </div>`;

    $("#divProductes").append(nouProducte);
});


/** Event Click que s'activa quan es clica la imatge de deleteProducte i esborra l'ultim fill del divProductes sempre i quan el length
 *  d'infoProducte sigui superior a 1 (Per evitar que s'esborri el primer producte) **/
$("#deleteProducte").on("click",function(){
    if($("#divProductes").find(".infoProducte").length > 1){
        $('#divProductes').children().last().remove();
    }
});


/** EVENTS CLICK que s'activen quan es clica als diferents inpuRadio del formulari de la llista de la compra.
*   Esborren les classes anteriors i afegeixen les noves classes, les quals canvien el fons de la llista.
*/
$("#banana").on("click",function(){
    $("#llistaCompra").removeClass();
    $("#llistaCompra").addClass("banana");
    $("#llistaCompra").addClass("llistaCompra");
});

$("#loto").on("click",function(){
    $("#llistaCompra").removeClass();
    $("#llistaCompra").addClass("loto");
    $("#llistaCompra").addClass("llistaCompra");
});

$("#classic").on("click",function(){
    $("#llistaCompra").removeClass();
    $("#llistaCompra").addClass("classic");
    $("#llistaCompra").addClass("llistaCompra");
});

$("#ploma").on("click",function(){
    $("#llistaCompra").removeClass();
    $("#llistaCompra").addClass("ploma");
    $("#llistaCompra").addClass("llistaCompra");
});
