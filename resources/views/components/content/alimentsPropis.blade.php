<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Kcal</th>
            <th>Prote</th>
            <th>Grasses</th>
            <th>Hidrats</th>
            <th>Categoria</th>
            <th>Imatge</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($aliments as $aliment)
            <tr>
                <td>{{$aliment->nom}}</td>
                <td>{{$aliment->kilocalories}} Kcal.</td>
                <td>{{$aliment->proteines}} g.</td>
                <td>{{$aliment->grasses}} g.</td>
                <td>{{$aliment->hidrats}} g.</td>
                <td>{{$aliment->categoria->nom}}</td>
                <td>{{$aliment->imatge->url}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
