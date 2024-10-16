@if(isset($data) && count($data) > 0)
<section>
        <div class="container">
            <div class="top-slider">
                <div id="jssor_1" class="jssor-1200">
                    <div data-u="slides" class="jssor-1200-container">
                        @foreach($data as $item)
                            <div>
                                <a  target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}" href="{{ isset($item->url)?$item->url:'' }}" title="{{ isset($item->title)?$item->title:'' }}">
                                    <img data-u="image" data-src2="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" title="{{ isset($item->title)?$item->title:'' }}" />
                                </a>
                                <div u="thumb">{{ isset($item->title)?$item->title:'' }}</div>
                            </div>
                        @endforeach
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
    </section>
@endif
    