@if (isset($data) && count($data) > 0)
    <div class="quick-link">
        <ul>
            @foreach ($data as $item)
                <li>
                    <a href="{{ isset($item->url)?$item->url:'' }}" target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}">
                        <i class="fas fa-question-circle"></i>{{ isset($item->title)?$item->title:'' }}
                    </a>
                </li>
            @endforeach
            {{-- <li><a href="/mobileswitch?mobile=false"><i class="far fa-check-circle"></i> Chuyển sang giao diện m&#225;y t&#237;nh</a></li> --}}

        </ul>
    </div>
@endif
