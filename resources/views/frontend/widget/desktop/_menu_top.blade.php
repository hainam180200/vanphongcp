@if (isset($data) && count($data) > 0)
    @foreach ($data as $item)
        <li><a target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}" href="{{$item->url}}">{{$item->title}}</a></li>  
    @endforeach
@endif