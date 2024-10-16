@if (isset($data) && count($data) > 0)
    <div class="top-slider">
        <div id="jssor_1" class="jssor-1200">
            <div data-u="slides" class="jssor-1200-container">
                @foreach ($data as $item)
                    <div>
                        <a target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}" href="{{ isset($item->url)?$item->url:'' }}" title="{{ isset($item->title)?$item->title:'' }}">
                            <img data-u="image" data-src2="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" title="{{ isset($item->title)?$item->title:'' }}" />
                        </a>
                        <div u="thumb">{{ isset($item->title)?$item->title:'' }}</div>
                    </div>
                @endforeach
            </div>
            <div data-u="navigator" class="homeslider-nav">
                <div data-u="prototype" class="nav">
                    <span></span>
                </div>
            </div>
        </div>

    </div>
@endif