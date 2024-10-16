

@if(isset($data) && count($data) > 0)

    <div class="td-mobile-content">
        <div class="menu-mainmenu-container">
            <ul id="menu-mainmenu" class="td-mobile-main-menu">
{{--                <li id="menu-item-99541" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-first menu-item-99541"><a href="/">Trang Chủ</a></li>--}}
                @foreach ($data as $key => $item)
                    @if ($item->parent_id == 0)
                <li id="menu-item-5201" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-5201">
                    <a href="/blog{{ isset($item->url)?$item->url:'' }}" target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}">{{ isset($item->title)?$item->title:'' }} <i class="td-icon-menu-right td-element-after"></i></a>
                    @if (isset($item->children) && count($item->children) > 0)
                    <ul class="sub-menu">
                        @foreach ($data as $key_child => $child_item)
                            @if($item->id == $child_item->parent_id)
                                <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-5202"><a href="/blog{{ isset($child_item->url)?$child_item->url:'' }}">{{$child_item->title}} </a></li>
                            @endif
                        @endforeach

                    </ul>

                    @endif
                </li>
                    @endif
                @endforeach

            </ul>
        </div>
    </div>
@endif
