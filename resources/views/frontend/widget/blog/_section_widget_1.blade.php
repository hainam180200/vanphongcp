@if (isset($data) && count($data) > 0)

<div class="td_block_wrap td_block_14 tdi_12_060 td-pb-full-cell td-pb-border-top td_block_template_1 td-column-2"  data-td-block-uid="tdi_12_060" >
    <div class="td-block-title-wrap"></div>
    <div id=tdi_12_060 class="td_block_inner td-column-2">
        <div class="td-block-row">
            @foreach ($data as $groupitem)
{{--                @foreach($groupitem->items as $item)--}}
            <div class="td-block-span6">
                <div class="td_module_mx1 td_module_wrap td-animation-stack">
                    <div class="td-module-thumb"><a href="/blog/{{ isset($groupitem->url)?$groupitem->url:$groupitem->slug }}" rel="bookmark" class="td-image-wrap" title="{{ isset($groupitem->title)?$groupitem->title:'' }}"><img width="356" height="220" class="entry-thumb" src="{{isset($groupitem->image)?\App\Library\Files::media($groupitem->image) : null }}"   alt="{{ isset($groupitem->title)?$groupitem->title:'' }}" title="{{ isset($groupitem->title)?$groupitem->title:'' }}" /></a></div>
                    <div class="td-module-meta-info">
                        <h3 class="entry-title td-module-title"><a href="/blog/{{ isset($groupitem->url)?$groupitem->url:$groupitem->slug }}" rel="bookmark" title="{{ isset($item->title)?$item->title:'' }}">{{ isset($item->title)?$item->title:'' }}</a></h3>
                        <div class="td-editor-date">
                            <a href="/blog/{{ isset($groupitem->url)?$groupitem->url:$groupitem->slug }}" class="td-post-category">{{ isset($groupitem->title)?$groupitem->title:'' }}</a>
                            @if(isset($groupitem->groups) && count($groupitem->groups) > 0)
                                @foreach($groupitem->groups as $group_items)
                                    <a href="/blog{{isset($group_items->url) ? $group_items->url : $group_items->slug}}" class="td-post-category">{{$group_items->title}}</a>
                                @endforeach
                            @endif
                            <span class="td-author-date">
                                <span class="td-post-date">
                                    <time class="entry-date updated td-module-date" datetime=" {{ isset($groupitem->created_at)?$groupitem->created_at:'' }}" >
                                       {{ isset($groupitem->created_at)?$groupitem->created_at:'' }}
                                    </time>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div> <!-- ./td-block-span6 -->
                @endforeach
{{--            @endforeach--}}

        </div><!--./row-fluid-->
    </div>
</div> <!-- ./block -->
@endif
