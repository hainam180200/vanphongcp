@if (isset($data) && count($data) > 0)
    <div class="menu">
        <ul>
            @foreach ($data as $item)
                @if ($item->parent_id == 0)
                    <li>
                        <a class="lv0 " href="{{ isset($item->url)?$item->url:'' }}" target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}">
                            <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" alt="">
                            <span>{{ isset($item->title)?$item->title:'' }}</span>
                            <i class="fas fa-caret-right"></i>
                        </a>
                        <div class="sub-container">
                            <div class="sub">
                                @foreach ($data as $key_child => $child_item)
                                    @if($item->id == $child_item->parent_id)
                                        <div class="menu g1">
                                            <h4><a href="{{ isset($child_item->url)?$child_item->url:'' }}">{{$child_item->title}}</a></h4>
                                            <ul class="display-column format_3">
                                                @foreach ($data as $m_child_item)
                                                    @if ($m_child_item->parent_id == $child_item->id)
                                                    <li><a href="{{ isset($m_child_item->url)?$m_child_item->url:'' }}">{{$m_child_item->title}}</a></li> 
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif