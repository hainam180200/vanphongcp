@if(isset($data) && count($data) > 0)
    @foreach($data as $key => $item)
        <div class="ads-container mt-2">
            <div class="ads-content">
                <a href="{{isset($item->url) ? $item->url : $item->slug}}" title="{{$item->title ?? ''}}">
                    <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" loading="lazy" alt="{{$item->title ?? ''}}">

                </a>
            </div>
        </div>
    @endforeach
@endif
