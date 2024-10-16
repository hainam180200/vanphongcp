@if (isset($data) && count($data) > 0)
    <section>
        <div class="container">
            <div class="quick-sales">
                @foreach ($data as $item)
                    <div class="item">
                        <a href="{{ isset($item->url)?$item->url:'' }}" target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}">
                            <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" title="{{ isset($item->title)?$item->title:'' }}" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
