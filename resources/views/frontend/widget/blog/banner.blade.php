
@if (isset($data) && count($data) > 0)

<div id="tdi_2_6c4" class="tdc-row"><div class="vc_row tdi_3_c8c  wpb_row td-pb-row" >
        <style scoped>

            /* custom css */
            .tdi_3_c8c{
                min-height: 0;
            }
        </style><div class="vc_column tdi_5_c8e  wpb_column vc_column_container tdc-column td-pb-span12">
            <style scoped>

                /* custom css */
                .tdi_5_c8e{
                    vertical-align: baseline;
                }
            </style><div class="wpb_wrapper"><div class="td_block_wrap td_block_slide tdi_6_ee1 td-pb-border-top td_block_template_1"  data-td-block-uid="tdi_6_ee1" >
                    <style>
                        /* custom css */
                        .tdi_6_ee1 .td-slide-meta{
                            max-width: calc(100% + 44px);
                        }.tdi_6_ee1 .entry-thumb{
                             background-position: center 50%;
                         }.tdi_6_ee1 .slide-meta-cat{
                              display: inline-block;
                          }.tdi_6_ee1 .td-post-author-name{
                               display: inline-block;
                           }.tdi_6_ee1 .td-post-date,
                            .tdi_6_ee1 .td-post-author-name span{
                                display: inline-block;
                            }.tdi_6_ee1 .td-post-comments{
                                 display: inline-block;
                             }.tdi_6_ee1 .td-slide-nav{
                                  font-size: 55px;
                              }.tdi_6_ee1 .td-theme-slider:hover .entry-thumb:before{
                                   opacity: 0;
                               }@media (max-width: 767px) {
                            .tdi_6_ee1 .td-slide-meta {
                                max-width: calc(100% + 24px);
                            }
                        }
                    </style>
                    <div class="td-block-title-wrap"></div>
                    <div id=tdi_6_ee1 class="td_block_inner">
                        <div id="tdi_7_2c1" class="td-theme-slider iosSlider-col-3 td_mod_wrap">
                            <div class="td-slider ">

                                @foreach ($data as $item)


                                <div id="tdi_7_2c1_item_{{$item->id}}" class = "td_module_slide td-animation-stack td-image-gradient">
                                    <div class="td-module-thumb">
                                        <a href="" rel="bookmark" class="td-image-wrap" title="{{ isset($item->title)?$item->title:'' }}">
                                            <span class="entry-thumb td-thumb-css " style="background-image: url(@if(isset($item->image) && $item->image != null) {{\App\Library\Files::media($item->image)}} @else /assets/frontend/image/news_trangchu.png @endif)" ></span>
                                        </a>
                                    </div>
                                    <div class="td-slide-meta">
                                        {{-- @if(isset($item->groups) && count($item->groups) > 0)
                                            @foreach($item->groups as $group_item)
                                                <span class="slide-meta-cat">
                                                <a href="/blog/{{ isset($groupitem)?$groupitem->url:$groupitem->slug }}">{{ isset($groupitem)?$groupitem->title:'' }}</a>
                                        </span>
                                            @endforeach
                                        @endif --}}


                                        <h3 class="entry-title td-module-title">
                                            <a href="/blog/{{ $item->url?$item->url:$item->slug }}" rel="bookmark" title="{{$item->title?$item->title:'' }}">
                                                {{ isset($item->title)?$item->title:'' }}
                                            </a>
                                        </h3>
                                        <div class="td-module-meta-info">
                                            <span class="td-post-date">
                                                <time class="entry-date updated td-module-date" datetime=" {{ isset($item->created_at)?$item->created_at:'' }}" >
                                                  {{ isset($item->created_at)?$item->created_at:'' }}
                                                </time>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                            </div>
{{--                            <i class="fas fa-chevron-left prevButton td-slide-nav"></i>--}}
{{--                            <i class="fas fa-chevron-right nextButton td-slide-nav"></i>--}}
                        </div>
                    </div>
                </div>
                <!-- ./block1 --></div>
        </div>
    </div>
    @endif
