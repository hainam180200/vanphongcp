@if (isset($data) && count($data) > 0)
    <div class="top-menu scroll">
        <ul class="scroll-x">
            @foreach ($data as $item)
            @if ($item->parent_id == 0)
                <li>
                    <a href="{{ isset($item->url)?$item->url:'' }}" target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}">
                        <div class="top-menu-in">
                            <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" class="filter-green" />
                        </div>
                        <span>{{ isset($item->title)?$item->title:'' }}</span>
                    </a>
                </li>
            @endif
            @endforeach
        </ul>
    </div>
@endif
