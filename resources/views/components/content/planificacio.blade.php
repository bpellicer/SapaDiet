<div class="mx-auto my-auto container">
    <div class="flex justify-center px-10 my-12">
        <div class="bg-green2 rounded-3xl border-2 border-black w-full lg:w-9/12 xl:w-7/12">
            <h1 class="font-bold text-center">Planificació</h1>
            <div class="px-10 pt-2 pb-11">
                <form action="planificacioUsuari" method="post">
                    @csrf
                   <div class="py-3">
                        <h1 class=" text-2xl">Nombre d'àpats</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <x-labelRadio for="apat2" src="/imatges/2.png" value="2"/>
                            <x-labelRadio for="apat3" src="/imatges/3.png" value="3"/>
                            <x-labelRadio for="apat4" src="/imatges/4.png" value="4"/>
                            <x-labelRadio for="apat5" src="/imatges/5.png" value="5"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Proteïnes preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 place-items-center">
                            <x-labelCheckbox src="/imatges/aliments/alaPollo.png" value="Pollastre" tipus="checkbox" nom="proteina[]" span="Pollastre"/>
                            <x-labelCheckbox src="/imatges/aliments/ou.png" value="Ou" tipus="checkbox" nom="proteina[]" span="Ou"/>
                            <x-labelCheckbox src="/imatges/aliments/carn.png" value="Carn" tipus="checkbox" nom="proteina[]" span="Carn"/>
                            <x-labelCheckbox src="/imatges/aliments/tofu.png" value="Tofu" tipus="checkbox" nom="proteina[]" span="Tofu"/>
                            <x-labelCheckbox src="/imatges/aliments/tonyina.png" value="Tonyina" tipus="checkbox" nom="proteina[]" span="Tonyina"/>
                            <x-labelCheckbox src="/imatges/aliments/peix.png" value="Peix" tipus="checkbox" nom="proteina[]" span="Peix"/>
                            <x-labelCheckbox src="/imatges/aliments/tempeh.png" value="Tempeh" tipus="checkbox" nom="proteina[]" span="Tempeh"/>
                            <x-labelCheckbox src="/imatges/aliments/carnsoja.png" value="Soja" tipus="checkbox" nom="proteina[]" span="Soja"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Carbohidrats preferits</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <x-labelCheckbox src="/imatges/aliments/arros.png" value="Arros" tipus="checkbox" nom="hidrats[]" span="Arròs"/>
                            <x-labelCheckbox src="/imatges/aliments/pa.png" value="Pa" tipus="checkbox" nom="hidrats[]" span="Pa"/>
                            <x-labelCheckbox src="/imatges/aliments/cigrons.png" value="Cigrons" tipus="checkbox" nom="hidrats[]" span="Cigrons"/>
                            <x-labelCheckbox src="/imatges/aliments/llenties.png" value="Llenties" tipus="checkbox" nom="hidrats[]" span="Llenties"/>
                            <x-labelCheckbox src="/imatges/aliments/patata.png" value="Patates" tipus="checkbox" nom="hidrats[]" span="Patates"/>
                            <x-labelCheckbox src="/imatges/aliments/quinoa.png" value="Quinoa" tipus="checkbox" nom="hidrats[]" span="Quinoa"/>
                            <x-labelCheckbox src="/imatges/aliments/avena.png" value="Avena" tipus="checkbox" nom="hidrats[]" span="Avena"/>
                            <x-labelCheckbox src="/imatges/aliments/pasta.png" value="Pasta" tipus="checkbox" nom="hidrats[]" span="Pasta"/>
                        </div>
                    </div>
                   <div class="py-3">
                        <h1 class=" text-2xl">Grasses preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <x-labelCheckbox src="/imatges/aliments/alvocat.png" value="Alvocat" tipus="checkbox" nom="grasses[]" span="Alvocat"/>
                            <x-labelCheckbox src="/imatges/aliments/anacard.png" value="Anacard" tipus="checkbox" nom="grasses[]" span="Anacard"/>
                            <x-labelCheckbox src="/imatges/aliments/atmetlla.png" value="Atmetlla" tipus="checkbox" nom="grasses[]" span="Atmetlla"/>
                            <x-labelCheckbox src="/imatges/aliments/cacahuet.png" value="Cacahuet" tipus="checkbox" nom="grasses[]" span="Cacahuet"/>
                            <x-labelCheckbox src="/imatges/aliments/chia.png" value="Chia" tipus="checkbox" nom="grasses[]" span="Chia"/>
                            <x-labelCheckbox src="/imatges/aliments/chocolata.png" value="Chocolata" tipus="checkbox" nom="grasses[]" span="Chocolata"/>
                            <x-labelCheckbox src="/imatges/aliments/nous.png" value="Nous" tipus="checkbox" nom="grasses[]" span="Nous"/>
                            <x-labelCheckbox src="/imatges/aliments/olives.png" value="Olives" tipus="checkbox" nom="grasses[]" span="Olives"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Làctics i begudes preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 place-items-center">
                            <x-labelCheckbox src="/imatges/aliments/formatge.png" value="Formatge" tipus="checkbox" nom="lactics[]" span="Formatge"/>
                            <x-labelCheckbox src="/imatges/aliments/iogur.png" value="Iogur" tipus="checkbox" nom="lactics[]" span="Iogur"/>
                            <x-labelCheckbox src="/imatges/aliments/llet.png" value="Llet" tipus="checkbox" nom="lactics[]" span="Llet"/>
                            <x-labelCheckbox src="/imatges/aliments/begudaAtmetlla.png" value="BegudaAtmetlla" tipus="checkbox" nom="lactics[]" span="B.Atmetlla"/>
                            <x-labelCheckbox src="/imatges/aliments/begudaSoja.png" value="BegudaSoja" tipus="checkbox" nom="lactics[]" span="B.Soja"/>
                            <x-labelCheckbox src="/imatges/aliments/begudaCoco.png" value="BegudaCoco" tipus="checkbox" nom="lactics[]" span="B.Coco"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Fruites preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <x-labelCheckbox src="/imatges/aliments/platan.png" value="Platan" tipus="checkbox" nom="fruites[]" span="Platan"/>
                            <x-labelCheckbox src="/imatges/aliments/maduixa.png" value="Maduixa" tipus="checkbox" nom="fruites[]" span="Maduixa"/>
                            <x-labelCheckbox src="/imatges/aliments/poma.png" value="Poma" tipus="checkbox" nom="fruites[]" span="Poma"/>
                            <x-labelCheckbox src="/imatges/aliments/pinya.png" value="Pinya" tipus="checkbox" nom="fruites[]" span="Pinya"/>
                            <x-labelCheckbox src="/imatges/aliments/sindria.png" value="Sindria" tipus="checkbox" nom="fruites[]" span="Sindria"/>
                            <x-labelCheckbox src="/imatges/aliments/kiwi.png" value="Kiwi" tipus="checkbox" nom="fruites[]" span="Kiwi"/>
                            <x-labelCheckbox src="/imatges/aliments/taronja.png" value="Taronja" tipus="checkbox" nom="fruites[]" span="Taronja"/>
                            <x-labelCheckbox src="/imatges/aliments/pera.png" value="Pera" tipus="checkbox" nom="fruites[]" span="Pera"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Objectius</h1>
                        <select name="objectius" id="objectiu" class="sm:ml-12">
                            <option value="perdre pes">Perdre pes</option>
                            <option value="guanyar pes">Guanyar pes</option>
                            <option value="mantenir pes">Mantenir pes</option>
                        </select>
                    </div>
                    <div class="flex justify-center mt-3">
                        <x-boto tipus="submit" classe="botoPerfil w-8/12 " text="Guarda"/>
                    </div>

                </form>

                <script>
                    /** Conversió de dades PHP a dades JSON **/
                    let planificacio = {!! json_encode($planificacio) !!};
                    let aliments = {!! json_encode($aliments) !!};

                    /** El select amb id objectiu selecciona l'opció que l´usuari té guardada a la BDD **/
                    $("#objectiu").val(planificacio.objectius);
                    /** El nombre d'àpats de la planificació escull el radio button corresponent **/
                    $("#apat"+planificacio.nombre_apats).prop("checked",true);

                    /** For que recorre l'array dels aliments seleccionats i amb l'ajuda de jQuery checheja aquells que l'Usuari té a la BDD **/
                    for(let i=0; i<aliments.length; i++){
                        $("#"+aliments[i]).attr("checked","checked");
                    }
                </script>
            </div>
        </div>
    </div>
</div>
