@if (isset($data))

    <div class="steering-scroll">
    <div class="steering-header">
        <a href="" class="c-pl-30 fw-600 text-uppercase lh-26 text-white"> Văn bản mới </a>
    </div>
    <div class="steering-scroll-list c-p-10">
        <ul>
            @foreach($data as $key => $item)
            <li>
                <a href="{{isset($item->url) ? $item->url : $item->slug}}" title="">
                    <span class="fw-600" >
                        {{ isset($item->id)?$item->id:'' }}
                    </span>
                </a>
                <br>
                <span class="font-italic">Ngày : {{isset($item) ? $item->updated_at->format('d/m/Y') : ''}}</span>
                <br>
                <a href="{{isset($item->url) ? $item->url : $item->slug}}" title="{{ isset($item->title)?$item->title:'' }}">
                    {{ isset($item->title)?$item->title:'' }}
                </a>
                <br>
                <a href="{{isset($item->url) ? $item->url : $item->slug}}" class="font-italic" target="_blank">Xem chi tiết ...</a>
            </li>
            @endforeach

        </ul>
    </div>
</div>
@endif
