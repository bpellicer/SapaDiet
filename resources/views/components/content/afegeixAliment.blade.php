<div class="container mx-auto my-auto">
    <div class="flex justify-center px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-8/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <h1 class="font-semibold">Afegeix un aliment</h1>
            <x-form method="POST" action="/addAliment" class="form">
                <div class="border-2 border-black flex justify-evenly">
                    <div class="py-3">
                        <label for="nomAliment" class="font-semibold">Nom Aliment</label>
                        <input type="text" class="rounded-2xl p-2" id="nomAliment" name="nomAliment" placeholder="Nom Aliment"/>
                    </div>
                    <div class="py-3">
                        <label for="categoria" class="font-semibold">Categoria</label>
                        <select name="categoria" id="" class="rounded-2xl" style="padding: 5.2px">
                            <option name="peix">Peixos</option>
                            <option name="carn">Carns</option>
                            <option name="ou">Ous</option>
                            <option name="verdura">Verdures</option>
                            <option name="llegum">Llegums i Fruits Secs</option>
                            <option name="lactic">Làctics</option>
                            <option name="fruita">Fruites</option>
                            <option name="oli">Mantequilles i Olis</option>
                            <option name="processat">Processats</option>
                            <option name="beguda">Begudes</option>
                        </select>
                    </div>
                </div>
                <h1>Valors energètics 100 grams</h1>
               <div class="border-2 border-black">
                   <div class="flex justify-evenly">
                       <div class="py-3">
                           <label for="prote" class="font-semibold">Proteïnes</label>
                           <input type="number" class="rounded-2xl p-2" id="prote" name="prote" placeholder="Proteïnes"/>
                       </div>
                       <div class="py-3">
                            <label for="hidrats" class="font-semibold">Carbohidrats</label>
                            <input type="number" class="rounded-2xl p-2" id="hidrats" name="hidrats" placeholder="Carbohidrats"/>
                       </div>
                    </div>
                   <div class="flex justify-evenly">
                       <div class="py-3">
                           <label for="grasses" class="font-semibold">Grasses</label>
                           <input type="number" class="rounded-2xl p-2" id="grasses" name="grasses" placeholder="Grasses"/>
                       </div>
                       <div class="py-3">
                           <label for="kcal" class="font-semibold">Kilocalories</label>
                           <input type="number" class="rounded-2xl p-2" id="kcal" name="kcal" placeholder="Kilocalories"/>
                       </div>
                    </div>
               </div>
               <div>
                   <button type="submit" class="" id="" name="">Afegeix aliment</button>
               </div>
            </x-form>
        </div>
    </div>
</div>
