@if(isset($data) && count($data) > 0)
{{--    @dd($data)--}}
    @foreach ($data as $key => $item)
        @if ($item->parent_id == 0)
            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children td-menu-item td-normal-menu menu-item-5201" id="{{$item->slug}}">
                <a href="{{ isset($item->url)?$item->url:'' }}" target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}">{{ isset($item->title)?$item->title:'' }} </a>
{{--                <i class="fas fa-angle-down"></i>--}}
                @if (isset($item->children) && count($item->children) > 0)
                <ul class="sub-menu">
                    @foreach ($data as $key_child => $child_item)
                        @if($item->id == $child_item->parent_id)
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category td-menu-item td-normal-menu menu-item-5202"><a href="{{ isset($child_item->url)?$child_item->url:'' }}">{{$child_item->title}} </a></li>
                        @endif
                    @endforeach

                </ul>
                @endif
            </li>

        @endif
    @endforeach
@endif
