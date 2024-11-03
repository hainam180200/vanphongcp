@if(isset($data) && count($data) > 0)
    @foreach($data as $key => $item)
        <div class="advertise-default row c-mt-8">
            <a href="{{isset($item->url) ? $item->url : $item->slug}}" title="{{$item->title ?? ''}}">
                <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" loading="lazy" alt="{{$item->title ?? ''}}" class="w-100">
            </a>
        </div>
    @endforeach
@endif
