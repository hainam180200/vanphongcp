@if(isset($data) && count($data) > 0)

    <div class="menu-category c-mt-8 d-none d-lg-block ">
    <ul class="main-menu d-flex justify-content-between">

        @foreach ($data as $key => $item)
            @if ($item->parent_id == 0)
                <li class="has-submenu">
                    <a href="{{ isset($item->url)?$item->url:$item->slug }}">
                        {{ isset($item->title)?$item->title:'' }} @if (isset($item->children) && count($item->children) > 0) <i class="fas fa-caret-down"></i> @endif
                    </a>
                    @if (isset($item->children) && count($item->children) > 0)
                    <ul class="submenu">
                        @foreach ($data as $key_child => $child_item)
                            @if($item->id == $child_item->parent_id)
                                <li>
                                    <a href="{{ isset($child_item->url)?$child_item->url:$child_item->slug }}" class="text-left">
                                        {{$child_item->title}}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
</div>
<div class="menu-category-mobile d-lg-none">
    <input type="checkbox" id="menu-toggle">
    <div class="menu-bar">
        <label for="menu-toggle" class="menu-icon"></label>
    </div>
    <div class="side-menu">
        <ul>
            @foreach ($data as $key => $item)
            @if ($item->parent_id == 0)
                <li class="has-submenu">
                    <a href="{{ isset($item->url)?$item->url:$item->slug }}" class="fz-16">
                        {{ isset($item->title)?$item->title:'' }} @if (isset($item->children) && count($item->children) > 0) <i class="fas fa-caret-down"></i> @endif
                    </a>
                    @if (isset($item->children) && count($item->children) > 0)
                        <ul class="submenu c-pl-12">
                            @foreach ($data as $key_child => $child_item)
                                @if($item->id == $child_item->parent_id)
                                    <li>
                                        <a href="{{ isset($child_item->url)?$child_item->url:$child_item->slug }}" class="text-left fz-14 lh-12">
                                            {{$child_item->title}}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endif
            @endforeach
        </ul>
    </div>
    <div class="overlay"></div>
</div>
@endif
