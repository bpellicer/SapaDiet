@props(['method'])

<form action = '{{$action}}' method="{{ $method =='get' ? 'get' : 'post'}}" {{$attributes->merge(['class'=> ''])}}>
    @if ($method != 'get')
        @csrf
    @endif
    @if (in_array(strtolower($method),['put','patch','delete']))
        @method($method)
    @endif
    {{$slot}}
</form>
