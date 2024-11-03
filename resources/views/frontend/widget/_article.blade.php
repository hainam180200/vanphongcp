<div class="steering-scroll">
    <div class="steering-header">
        <a href="#" class="c-pl-30 fw-600 text-uppercase lh-26 text-white"> Thông tin mới nhất </a>
    </div>
    <div class="steering-scroll-list c-p-10">
        @if(isset($data) && count($data) > 0)
        <ul>
            @foreach($data as $key => $item)
            <li>
                <a href="{{isset($item->url) ? $item->url : $item->slug}}" class="d-flex" title="{{ isset($item->title)?$item->title:'' }}">
                    <div class="c-mr-4">
                        <img src="/assets/frontend/image/star.png" loading="lazy">
                    </div>
                    <span class="text-limit limit-3 t-body-1">
                        {{ isset($item->title)?$item->title:'' }}
                    </span>
                </a>
            </li>
            @endforeach

        </ul>
        @endif
    </div>
</div>
