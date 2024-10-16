@if(isset($data) && count($data) > 0)
<!-- nav -->
 <nav>
    <div class="container">
        <ul class="root">
            @foreach ($data as $key => $item)
                @if ($item->parent_id == 0)
                    <li id="{{$item->slug}}">
                        <a href="{{ isset($item->url)?$item->url:'' }}" target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}" >
                            @if(isset($item->image))
                            <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" class="filter-green" />
                            @endif
                            <span>{{ isset($item->title)?$item->title:'' }}</span>
                        </a>
                        @if (isset($item->children) && count($item->children) > 0)
                            <div class="sub-container">
                                <div class="sub">
                                    @foreach ($data as $key_child => $child_item)
                                        @if($item->id == $child_item->parent_id)
                                            <div class="menu g2">
                                                <h4><a href="{{ isset($child_item->url)?$child_item->url:'' }}">{{$child_item->title}}</a></h4>
                                                <ul class="display-row format_2">
                                                    @foreach ($data as $m_child_item)
                                                        @if ($m_child_item->parent_id == $child_item->id)
                                                            <li><a href="{{ isset($m_child_item->url)?$m_child_item->url:$m_child_item->slug }}">{{$m_child_item->title}}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="menu ads"></div>
                                </div>
                            </div>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>
<!-- nav -->
@endif
