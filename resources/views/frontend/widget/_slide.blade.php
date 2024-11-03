@if (isset($data))
<div class="article-slide row c-p-4">
    <div class="article-left col-lg-7 c-px-0">
        <div id="article-content">
            <div class="article-content-img">
                <img src="{{ isset($data[0]->image)?\App\Library\Files::media($data[0]->image) : null }}" style="width: 100%;" title="{{ isset($data[0]->title)?$data[0]->title:'' }}" />
            </div>
            <div class="c-p-8">
                {{ isset($data[0]->title)?$data[0]->title:'' }}
            </div>
        </div>
    </div>
    <div class="article-right col-lg-5 c-px-4">
        <div class="article-list">
            @foreach($data as $key => $item)
            <div class="article-item c-my-4 c-p-4 {{$key ==0 ? 'active' : ''}} " data-index="{{$key}}">
                <a href="{{isset($item->url) ? $item->url : $item->slug}}" target="{{isset($item->target) && $item->target == 1 ? '_blank' : null}} " class="d-flex">
                    <div class="c-mr-4 article-image">
                        <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" style="width: 100%;" title="{{ isset($item->title)?$item->title:'' }}" />
                    </div>
                    <div class="article-text text-limit limit-3">
                        {{ isset($item->title)?$item->title:'' }}
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
