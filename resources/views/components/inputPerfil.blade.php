
    <label class="block mb-2 text-sm font-bold text-gray-700 text-left" for="{{$nom}}">{{$placeholder}}</label>
    <input
        class="{{$classe}}"
        id="{{$id}}"
        name="{{$nom}}"
        type="{{$tipus}}"
        placeholder="{{$placeholder}}"
        value="{{auth()->user()->$nom}}" />
