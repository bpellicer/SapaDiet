@include('partials.headcontent')
<x-layout.navAuth/>
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
                            <x-labelCheckbox for="proteina1" src="/imatges/aliments/alaPollo.png" value="Pollastre" tipus="checkbox" nom="proteina[]" span="Pollastre"/>
                            <x-labelCheckbox for="proteina2" src="/imatges/aliments/ou.png" value="Ou" tipus="checkbox" nom="proteina[]" span="Ou"/>
                            <x-labelCheckbox for="proteina3" src="/imatges/aliments/carn.png" value="Carn" tipus="checkbox" nom="proteina[]" span="Carn"/>
                            <x-labelCheckbox for="proteina4" src="/imatges/aliments/tofu.png" value="Tofu" tipus="checkbox" nom="proteina[]" span="Tofu"/>
                            <x-labelCheckbox for="proteina5" src="/imatges/aliments/tonyina.png" value="Tonyina" tipus="checkbox" nom="proteina[]" span="Tonyina"/>
                            <x-labelCheckbox for="proteina6" src="/imatges/aliments/peix.png" value="Peix" tipus="checkbox" nom="proteina[]" span="Peix"/>
                            <x-labelCheckbox for="proteina7" src="/imatges/aliments/tempeh.png" value="Tempeh" tipus="checkbox" nom="proteina[]" span="Tempeh"/>
                            <x-labelCheckbox for="proteina8" src="/imatges/aliments/carnsoja.png" value="Soja" tipus="checkbox" nom="proteina[]" span="Soja"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Carbohidrats preferits</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <x-labelCheckbox for="hidrats1" src="/imatges/aliments/arros.png" value="Arros" tipus="checkbox" nom="hidrats[]" span="Arròs"/>
                            <x-labelCheckbox for="hidrats2" src="/imatges/aliments/pa.png" value="Pa" tipus="checkbox" nom="hidrats[]" span="Pa"/>
                            <x-labelCheckbox for="hidrats3" src="/imatges/aliments/cigrons.png" value="Cigrons" tipus="checkbox" nom="hidrats[]" span="Cigrons"/>
                            <x-labelCheckbox for="hidrats4" src="/imatges/aliments/llenties.png" value="Llenties" tipus="checkbox" nom="hidrats[]" span="Llenties"/>
                            <x-labelCheckbox for="hidrats5" src="/imatges/aliments/patata.png" value="Patates" tipus="checkbox" nom="hidrats[]" span="Patates"/>
                            <x-labelCheckbox for="hidrats6" src="/imatges/aliments/quinoa.png" value="Quinoa" tipus="checkbox" nom="hidrats[]" span="Quinoa"/>
                            <x-labelCheckbox for="hidrats7" src="/imatges/aliments/avena.png" value="Avena" tipus="checkbox" nom="hidrats[]" span="Avena"/>
                            <x-labelCheckbox for="hidrats8" src="/imatges/aliments/pasta.png" value="Pasta" tipus="checkbox" nom="hidrats[]" span="Pasta"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Grasses preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <x-labelCheckbox for="grasses1" src="/imatges/aliments/alaPollo.png" value="Pollastre" tipus="checkbox" nom="proteina[]" span="Pollastre"/>
                            <x-labelCheckbox for="grasses2" src="/imatges/aliments/ou.png" value="Ou" tipus="checkbox" nom="proteina[]" span="Ou"/>
                            <x-labelCheckbox for="grasses3" src="/imatges/aliments/carn.png" value="Carn" tipus="checkbox" nom="proteina[]" span="Carn"/>
                            <x-labelCheckbox for="grasses4" src="/imatges/aliments/tofu.png" value="Tofu" tipus="checkbox" nom="proteina[]" span="Tofu"/>
                            <x-labelCheckbox for="grasses5" src="/imatges/aliments/tonyina.png" value="Tonyina" tipus="checkbox" nom="proteina[]" span="Tonyina"/>
                            <x-labelCheckbox for="grasses6" src="/imatges/aliments/peix.png" value="Peix" tipus="checkbox" nom="proteina[]" span="Peix"/>
                            <x-labelCheckbox for="grasses7" src="/imatges/aliments/tempeh.png" value="Tempeh" tipus="checkbox" nom="proteina[]" span="Tempeh"/>
                            <x-labelCheckbox for="grasses8" src="/imatges/aliments/carnsoja.png" value="Soja" tipus="checkbox" nom="proteina[]" span="Soja"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Làctics i begudes preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <x-labelCheckbox for="lactics1" src="/imatges/aliments/alaPollo.png" value="Pollastre" tipus="checkbox" nom="proteina[]" span="Pollastre"/>
                            <x-labelCheckbox for="lactics2" src="/imatges/aliments/ou.png" value="Ou" tipus="checkbox" nom="proteina[]" span="Ou"/>
                            <x-labelCheckbox for="lactics3" src="/imatges/aliments/carn.png" value="Carn" tipus="checkbox" nom="proteina[]" span="Carn"/>
                            <x-labelCheckbox for="lactics4" src="/imatges/aliments/tofu.png" value="Tofu" tipus="checkbox" nom="proteina[]" span="Tofu"/>
                            <x-labelCheckbox for="lactics5" src="/imatges/aliments/tonyina.png" value="Tonyina" tipus="checkbox" nom="proteina[]" span="Tonyina"/>
                            <x-labelCheckbox for="lactics6" src="/imatges/aliments/peix.png" value="Peix" tipus="checkbox" nom="proteina[]" span="Peix"/>
                            <x-labelCheckbox for="lactics7" src="/imatges/aliments/tempeh.png" value="Tempeh" tipus="checkbox" nom="proteina[]" span="Tempeh"/>
                            <x-labelCheckbox for="lactics8" src="/imatges/aliments/carnsoja.png" value="Soja" tipus="checkbox" nom="proteina[]" span="Soja"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Fruites preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <x-labelCheckbox for="fruita1" src="/imatges/aliments/alaPollo.png" value="Pollastre" tipus="checkbox" nom="proteina[]" span="Pollastre"/>
                            <x-labelCheckbox for="fruita2" src="/imatges/aliments/ou.png" value="Ou" tipus="checkbox" nom="proteina[]" span="Ou"/>
                            <x-labelCheckbox for="fruita3" src="/imatges/aliments/carn.png" value="Carn" tipus="checkbox" nom="proteina[]" span="Carn"/>
                            <x-labelCheckbox for="fruita4" src="/imatges/aliments/tofu.png" value="Tofu" tipus="checkbox" nom="proteina[]" span="Tofu"/>
                            <x-labelCheckbox for="fruita5" src="/imatges/aliments/tonyina.png" value="Tonyina" tipus="checkbox" nom="proteina[]" span="Tonyina"/>
                            <x-labelCheckbox for="fruita6" src="/imatges/aliments/peix.png" value="Peix" tipus="checkbox" nom="proteina[]" span="Peix"/>
                            <x-labelCheckbox for="fruita7" src="/imatges/aliments/tempeh.png" value="Tempeh" tipus="checkbox" nom="proteina[]" span="Tempeh"/>
                            <x-labelCheckbox for="fruita8" src="/imatges/aliments/carnsoja.png" value="Soja" tipus="checkbox" nom="proteina[]" span="Soja"/>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Objectius</h1>
                        <select name="" id="">
                            <option value="perdrePes">Perdre pes</option>
                            <option value="perdrePes">Guanyar pes</option>
                            <option value="perdrePes">Mantenir pes</option>
                        </select>
                    </div>
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
</div>
<x-layout.footerAuth/>
