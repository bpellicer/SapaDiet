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
                            <label for="apat2" class="rounded-full bg-white">
                                <input class="radio" id="apat2" type="radio" name="apat" value="2" checked>
                                <img src ="/imatges/2.png" width="70px" class="rounded-full bg-white cursor-pointer imatgePlanificacio" name="apat2">
                            </label>
                            <label for="apat3" class="rounded-full bg-white">
                                <input class="radio"  type="radio" id="apat3" name="apat" value="3">
                                <img src ="/imatges/3.png" width="70px" class="rounded-full bg-white cursor-pointer imatgePlanificacio" name="apat3">
                            </label>
                            <label for="apat4" class="rounded-full bg-white">
                                <input class="radio"  type="radio" id="apat4" name="apat" value="4">
                                <img src ="/imatges/4.png" width="70px" class="rounded-full bg-white cursor-pointer imatgePlanificacio" name="apat4">
                            </label>
                            <label for="apat5" class="rounded-full bg-white">
                                <input class="radio"  type="radio" id="apat5" name="apat" value="5">
                                <img src ="/imatges/5.png" width="70px" class="imatgePlanificacio" name="apat5">
                            </label>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Proteïnes preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">

                            <label for="proteina1" class="rounded-full bg-white">
                                <input type="checkbox" id="proteina1" name="proteina[]" value="alaPollo" class="checkProva">
                                <img src="/imatges/aliments/alaPollo.png" width="70px" name="proteina1" class="rounded-full bg-white">
                            </label>

                            <label for="proteina2" class="rounded-full bg-white">
                                <input type="checkbox" id="proteina2" name="proteina[]" value="ou" class="checkProva">
                                <img src="/imatges/aliments/ou.png" width="70px" name="proteina2" class="rounded-full bg-white">
                            </label>


                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Carbohidrats preferits</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Grasses preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Làctics i begudes preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                        </div>
                    </div>
                    <div class="py-3">
                        <h1 class=" text-2xl">Fruites preferides</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 place-items-center">
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
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
