<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-8/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <h1 class="font-bold text-xl sm:text-2xl md:text-3xl">Progrés</h1>
            <div class="grid grid-cols-1">
                <x-form method="POST" action="/addPesAltura" class="form">
                    <div class="grid grid-cols-4 gap-0">
                        <div class=" p-3 place-self-end mb-2">
                            <label for="pes" class="inline-block font-bold ">Pes corporal: </label>
                        </div>
                        <div class=" p-3 place-self-start">
                            <input type="number" name="pes" value="" class="rounded-2xl p-2 mt-2 w-20">
                            <span>Kg</span>
                        </div>
                        <div class=" p-3 place-self-end mb-2">
                            <label for="altura" class="inline-block font-bold ">Altura: </label>
                        </div>
                        <div class=" p-3 place-self-start">
                            <input type="number" name="altura" value="" class="rounded-2xl p-2 mt-2 w-20">
                            <span>Cm</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <input type="submit" class="botoEstandar cursor-pointer" value="Guardar">
                    </div>
                </x-form>
                <div class="mt-4">
                    <h2>El teu IMC corporal és: </h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Índex de massa corporal</th>
                                <th>Classificació</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><p> < 16.00</p></td>
                                <td><p>Pes baix: Primor severa</p></td>
                            </tr>
                            <tr>
                                <td><p> 16.00 - 16.99</p></td>
                                <td><p>Pes baix: Primor moderada</p></td>
                            </tr>
                            <tr>
                                <td><p> 17.00 - 18.49</p></td>
                                <td><p>Pes baix: Primor acceptable</p></td>
                            </tr>
                            <tr>
                                <td><p> 18.50 - 24.99</p></td>
                                <td><p>Pes normal</p></td>
                            </tr>
                            <tr>
                                <td><p> 25.00 - 29.99</p></td>
                                <td><p>Sobrepès</p></td>
                            </tr>
                            <tr>
                                <td><p> 30.00 - 34.99</p></td>
                                <td><p>Obesitat: Tipus I</p></td>
                            </tr>
                            <tr>
                                <td><p> 35.00 - 40.00</p></td>
                                <td><p>Obesitat: Tipus II</p></td>
                            </tr>
                            <tr>
                                <td><p> > 40.00</p></td>
                                <td><p>Obesitat: Tipus III</p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
