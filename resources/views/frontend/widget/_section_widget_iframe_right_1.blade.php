@if(isset($data) && count($data) > 0)
    @foreach($data as $key => $item)
        <div class="ads-container mt-2">
            <div class="steering-header">
                <a href="{{isset($item->url) ? $item->url : $item->slug}}" class="c-pl-30 fw-600 text-uppercase lh-26 text-white">
                    {{$item->title}}
                </a>
            </div>
            <div class="ads-content">
                {!! $item->content !!}
            </div>
        </div>
    @endforeach
@endif
