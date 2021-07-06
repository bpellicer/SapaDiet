<div class="mb-2">
    <label class="block mb-2 text-sm font-bold text-gray-700" for="{{$nom}}">{{$placeholder}}</label>
    <input
        class="{{$classe}}"
        id="{{$id}}"
        name="{{$nom}}"
        type="{{$tipus}}"
        placeholder="{{$placeholder}}"
        @if ($tipus!='password')
        value='{{old("$nom")}}'
        @endif
        />
</div>
