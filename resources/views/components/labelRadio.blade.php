<label for="{{$for}}" class="rounded-full bg-white">
    <input class="radio" id="{{$for}}" type="radio" name="apat" value="{{$value}}" @if($value == 2)checked @endif>
    <img src ="{{$src}}" width="70px" class="imatgePlanificacio" name="{{$for}}">
</label>
