@if(isset($data) && count($data) > 0)

    <div id="bannerTopHead" class="c-pt-12 c-pt-lg-0">
        <div class="swiper-banner">
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
    </div>
@endif
