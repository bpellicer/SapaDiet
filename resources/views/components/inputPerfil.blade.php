
    <label class="block text-sm font-bold text-gray-700 text-left" for="{{$nom}}">{{$placeholder}}</label>
    <input
        class="{{$classe}}"
        id="{{$id}}"
        name="{{$nom}}"
        type="{{$tipus}}"
        placeholder="{{$placeholder}}"
        value="{{auth()->user()->$nom}}"
        @if ($nom =='email')
        disabled
        @endif
        />
