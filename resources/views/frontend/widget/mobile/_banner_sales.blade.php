@if (isset($data) && count($data) > 0)
    <section class="scroll">
        <div class="quick-sales scroll-x">
            @foreach ($data as $item)
                <div class="item">
                    <a href="{{ isset($item->url)?$item->url:'' }}" title="{{ isset($item->title)?$item->title:'' }}" target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}}">
                        <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" title="{{ isset($item->title)?$item->title:'' }}" class="img-fluid" />
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endif