<div class="container mx-auto my-auto">
    <div class="flex justify-center px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-10/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <div class="flex justify-center">
                <table>
                    <thead>
                        <tr>
                            <th>Imatge</th>
                            <th>Categoria</th>
                            <th>Nom</th>
                            <th>Kilocalories</th>
                            <th>Proteines</th>
                            <th>Hidrats</th>
                            <th>Grasses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aliments as $aliment)
                            <tr>
                                <td><img src="{{$aliment->categoria->imatge->url}}" alt=""></td>
                                <td>{{$aliment->categoria->nom}}</td>
                                <td>{{$aliment->nom}}</td>
                                <td>{{$aliment->kilocalories}}</td>
                                <td>{{$aliment->proteines}}</td>
                                <td>{{$aliment->hidrats}}</td>
                                <td>{{$aliment->grasses}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
