@if (isset($data) && count($data) > 0)
<div class="td_block_wrap td_block_7 tdi_21_989 td-pb-border-top td_block_template_1 td-column-1 td_block_padding"  data-td-block-uid="tdi_21_989" >
    <div class="td-block-title-wrap">
        <h4 class="block-title td-block-title">
            <span class="td-pulldown-size">BÀI VIẾT ĐÁNG CHÚ Ý</span>
        </h4>
    </div>

    <div id=tdi_21_989 class="td_block_inner">
        @foreach ($data as $item)


{{--            @foreach($groupitem->items as $item)--}}

        <div class="td-block-span12">
            <div class="td_module_6 td_module_wrap td-animation-stack">
                <div class="td-module-thumb">
                    <a href="/blog/{{ isset($item->url)?$item->url:$item->slug }}" rel="bookmark" class="td-image-wrap" title="{{ isset($item->title)?$item->title:'' }}" >
                        <img width="100" height="70" class="entry-thumb" src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}"  srcset="{{ isset($item->image)?\App\Library\Files::media($item->image): null}} 100w,{{ isset($item->image)?\App\Library\Files::media($item->image): null}} 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="{{ isset($item->title)?$item->title:'' }}" title="{{ isset($item->title)?$item->title:'' }}" />
                    </a>
                </div>
                <div class="item-details">
                    <h3 class="entry-title td-module-title">
                        <a href="/blog/{{ isset($item->url)?$item->url:$item->slug }}" rel="bookmark" title="{{ isset($item->title)?$item->title:'' }}" style="    display: -webkit-box;    -webkit-line-clamp: 2;    -webkit-box-orient: vertical;overflow: hidden;">{{ isset($item->title)?$item->title:'' }}</a></h3>
                    <div class="td-module-meta-info">
                        @if(isset($item->groups) && count($item->groups) > 0)
                            @foreach($item->groups as $group_items)
                                <a href="/blog{{isset($group_items->url) ? $group_items->url : $group_items->slug}}" class="td-post-category" >{{$group_items->title}}</a>
                            @endforeach
                        @endif

                        <span class="td-post-date">
                            <time class="entry-date updated td-module-date" datetime=" {{ isset($item->created_at)?$item->created_at:'' }}" >
                                  {{ isset($item->created_at)?$item->created_at:'' }}
                            </time>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
{{--    @endforeach--}}
        <!-- ./td-block-span12 -->



        <!-- ./td-block-span12 -->
    </div>
</div>
@endif
