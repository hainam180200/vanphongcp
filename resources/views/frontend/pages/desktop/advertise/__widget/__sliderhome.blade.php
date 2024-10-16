<section>
{{--    @dd($data)--}}
    @if(isset($data) && count($data) > 0)
    <div class="container">
        <div class="top-slider">
            <div id="jssor_1" class="jssor-1200">
                <!-- Loading Screen -->
                {{--                    <div data-u="loading" class="jssor-spin">--}}
                {{--                        <img src="/Content/web/img/spin.svg" />--}}
                {{--                    </div>--}}
                <div data-u="slides" class="jssor-1200-container">

                    @foreach($data as $item)
                    <div>
                        <a target="_blank" href="{{ isset($item->url)?$item->url:'' }}" title="{{ isset($item->title)?$item->title:'' }}"><img data-u="image" data-src2="{{ isset($item->image)?$item->image:'' }}" title="{{ isset($item->title)?$item->title:'' }}" /></a>
                        <div u="thumb">{{ isset($item->title)?$item->title:'' }}</div>
                    </div>
                    @endforeach
{{--                    <div>--}}
{{--                        <a target="_blank" href="/" title="Galaxy A Series - Giảm gi&#225; cuối năm"><img data-u="image" data-src2="https://cdn.hoanghamobile.com/i/home/Uploads/2021/12/23/galaxy-a-series-giam-so-c-cuo-i-nam-1200x382-3190.jpg" title="Galaxy A Series - Giảm gi&#225; cuối năm" /></a>--}}
{{--                        <div u="thumb">Galaxy A Series - Giảm gi&#225; cuối năm</div>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <a target="_blank" href="/" title="Mua si&#234;u phẩm Z Fold3/ Z Flip3"><img data-u="image" data-src2="https://cdn.hoanghamobile.com/i/home/Uploads/2021/12/16/web-fold-filp-01.jpg" title="Mua si&#234;u phẩm Z Fold3/ Z Flip3" /></a>--}}
{{--                        <div u="thumb">Mua si&#234;u phẩm Z Fold3/ Z Flip3</div>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <a target="_blank" href="/" title="iPhone 13 Series - Gi&#225; sốc"><img data-u="image" data-src2="https://cdn.hoanghamobile.com/i/home/Uploads/2021/12/14/iphone-13-series-pre-web.jpg" title="iPhone 13 Series - Gi&#225; sốc" /></a>--}}
{{--                        <div u="thumb">iPhone 13 Series - Gi&#225; sốc</div>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <a target="_blank" href="/" title="Mở b&#225;n Poco M4 Pro 5G - Nhận qu&#224; khủng"><img data-u="image" data-src2="https://cdn.hoanghamobile.com/i/home/Uploads/2021/12/15/lcd-pocom4-web.png" title="Mở b&#225;n Poco M4 Pro 5G - Nhận qu&#224; khủng" /></a>--}}
{{--                        <div u="thumb">Mở b&#225;n Poco M4 Pro 5G - Nhận qu&#224; khủng</div>--}}
{{--                    </div>--}}
                </div>
                <div data-u="thumbnavigator" class="jssor-1200-thumbs">
                    <div data-u="slides" style="cursor: pointer">
                        <div data-u="prototype" class="p">
                            <div class=w>
                                <div data-u="thumbnailtemplate"></div>
                            </div>
                            <div class=c></div>
                        </div>
                    </div>
                </div>
                <div data-u="arrowleft" class="slider-arr slider-arr-l" data-autocenter="2">
                    <i class="fas fa-chevron-left"></i>                  </div>
                <div data-u="arrowright" class="slider-arr slider-arr-r" data-autocenter="2">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
