@if(isset($data) && count($data) > 0)
    <div class="swiper-ads">
        <div class="swiper-wrapper" >
            @foreach($data as $key => $item)
                <div class="swiper-slide" >
                    <a href="{{isset($item->url) ? $item->url : $item->slug}}">
                        <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" loading="lazy">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endif
