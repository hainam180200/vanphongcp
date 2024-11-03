@if (isset($category))
<div class="article-default row c-p-4 c-mt-8">
    <div class="article-header w-100">
        <a href="">
            {{$category->title}}
        </a>
    </div>
    <div class="article-content c-mt-12">
        @if(isset($data) && count($data) > 0)

        <div class="article-content-first">
            <img src="{{ isset($data[0]->item->image)?\App\Library\Files::media($data[0]->item->image) : null }}" alt="">
            <div class="article-content-title ">
                <a href="{{isset($data[0]->item->url) ? $data[0]->item->url : $data[0]->item->slug}}" title=" {{ isset($data[0]->item->title)?$data[0]->item->title:'' }}" class="text-title fz-18 fz-lg-16">
                    {{ isset($data[0]->item->title)?$data[0]->item->title:'' }}
                </a>
            </div>
        </div>
        <div class="clear"></div>
        <div class="article-content-item">
            <ul>
                @foreach($data as $key => $item)
                    @if($key > 0)
                        <li>
                            <span class="fz-15 fz-lg-12">{{isset($item->item) ? $item->item->updated_at->format('d/m/Y') : ''}}</span>
                            <a href="{{isset($item->item->url) ? $item->item->url : $item->item->slug}}" class="fz-13 fz-lg-12 c-ml-4">
                                {{ isset($item->item->title)?$item->item->title:'' }}
                            </a>
                        </li>
                    @endif

                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endif
