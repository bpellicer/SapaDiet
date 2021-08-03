<div class="container bg-green3 border-2 border-black">
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
