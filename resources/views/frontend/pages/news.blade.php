@extends('frontend.layouts.master_blog')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@push('style')
    <link rel="stylesheet" href="/assets/frontend/css/news.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
@endpush
@push('js')
    <script type='text/javascript' src='/assets/frontend/lib/jquery.min.js'></script>
    <script type='text/javascript' src='/assets/frontend/lib/jquery-migrate.min.js'></script>
@endpush
@section('content')
<div class="td-main-content-wrap td-main-page-wrap td-container-wrap">
    {!! widget('frontend.widget.blog.banner') !!}
    <div class="tdc-content-wrap">

        <div id="tdi_8_eea" class="tdc-row">
            <div class="vc_row tdi_9_ea1  wpb_row td-pb-row" >
                <style scoped>

                    /* custom css */
                    .tdi_9_ea1{
                        min-height: 0;
                    }
                </style><div class="vc_column tdi_11_74a  wpb_column vc_column_container tdc-column td-pb-span8">
                    <style scoped>

                        /* custom css */
                        .tdi_11_74a{
                            vertical-align: baseline;
                        }
                    </style>
                    <div class="wpb_wrapper">
                        {!! widget('frontend.widget.blog._section_widget_1') !!}
                        <div class="clearfix"></div>
                        <div class="td_block_wrap td_block_11 tdi_13_114 td_with_ajax_pagination td-pb-border-top td_block_template_1 td-column-2"  data-td-block-uid="tdi_13_114" ><script>var block_tdi_13_114 = new tdBlock();

                            </script>
                            <div class="td-block-title-wrap"></div>
                            <div id=tdi_13_114 class="td_block_inner">
                                @if (isset($items_prd) && count($items_prd) > 0)
                                    @foreach ($items_prd as $item)
                                <div class="td-block-span12">
                                    <div class="td_module_10 td_module_wrap td-animation-stack">
                                        <div class="td-module-thumb"><a href="/blog/{{isset($item->url) ? $item->url : $item->slug}}"><img width="218" height="150" class="entry-thumb" src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}"  srcset="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }} 218w, {{ isset($item->image)?\App\Library\Files::media($item->image) : null }} 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="concept-xiaomi-mix-5-1" title="{{isset($item->title) ? $item->title : null}}" /></a></div>
                                        <div class="item-details">
                                            <h3 class="entry-title td-module-title"><a href="/blog/{{isset($item->url) ? $item->url : $item->slug}}" rel="bookmark" title="{{isset($item->title) ? $item->title : null}}">{{isset($item->title) ? $item->title : null}}</a></h3>
                                            <div class="td-module-meta-info">

                                                @if(isset($item->groups) && count($item->groups) > 0)
                                                    @foreach($item->groups as $group_item)
                                                         <a href="/blog{{isset($group_item->url) ? $group_item->url : $group_item->slug}}" class="td-post-category">{{$group_item->title}}</a>
                                                    @endforeach
                                                @endif

                                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="{{isset($item->created_at) ? $item->created_at : $item->created_at}}" > {{isset($item->created_at) ? $item->created_at : ''}}</time></span>                                        </div>

                                            <div class="td-excerpt" style="    display: -webkit-box; -webkit-line-clamp: 2;line-break: auto;text-overflow: ellipsis; -webkit-box-orient: vertical;">
                                                {!! isset($item->description) ? $item->description : '' !!}
                                            </div>
                                        </div>

                                    </div>


                                </div> <!-- ./td-block-span12 -->
                                    @endforeach
                                @endif
        <div class="text-center paginate_blog">
            {!! $items_prd->links(); !!}
        </div>



                            </div>
{{--                            <div class="td-next-prev-wrap">--}}
{{--                                <a href="#" class="td-ajax-prev-page ajax-page-disabled" id="prev-page-tdi_13_114" data-td_block_id="tdi_13_114">--}}
{{--                                    <i class="td-icon-font td-icon-menu-left"></i>--}}
{{--                                </a>--}}
{{--                                <a href="#"  class="td-ajax-next-page" id="next-page-tdi_13_114" data-td_block_id="tdi_13_114">--}}
{{--                                    <i class="td-icon-font td-icon-menu-right"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                        </div>
                        <!-- ./block --></div>
                </div><div class="vc_column tdi_15_c6a  wpb_column vc_column_container tdc-column td-pb-span4">
                    <style scoped>

                        /* custom css */
                        .tdi_15_c6a{
                            vertical-align: baseline;
                        }
                    </style>
{{--                    <div class="wpb_wrapper"><div class="td_block_wrap td_block_social_counter tdi_16_1ec td-social-style5 td-social-boxed td-pb-border-top td_block_template_1"><div class="td-block-title-wrap"><h4 class="block-title td-block-title"><span class="td-pulldown-size">KẾT NỐI </span></h4></div><div class="td-social-list"><div class="td_social_type td-pb-margin-side td_social_facebook"><div class="td-social-box"><div class="td-sp td-sp-facebook"></div><span class="td_social_info td_social_info_counter">670,878</span><span class="td_social_info td_social_info_name">Thành viên</span><span class="td_social_button"><a href="/"  >Thích</a></span></div></div><div class="td_social_type td-pb-margin-side td_social_instagram"><div class="td-social-box"><div class="td-sp td-sp-instagram"></div><span class="td_social_info td_social_info_counter">13,555</span><span class="td_social_info td_social_info_name">Người theo dõi</span><span class="td_social_button"><a href="/"  >Theo dõi</a></span></div></div><div class="td_social_type td-pb-margin-side td_social_youtube"><div class="td-social-box"><div class="td-sp td-sp-youtube"></div><span class="td_social_info td_social_info_counter">65,400</span><span class="td_social_info td_social_info_name">Người theo dõi</span><span class="td_social_button"><a href="/"  >Đăng Ký</a></span></div></div></div></div> <!-- ./block --><div class="vc_row_inner tdi_18_ec1  vc_row vc_inner wpb_row td-pb-row" >--}}
                            <style scoped>

                                /* custom css */
                                .tdi_18_ec1{
                                    position: relative !important;
                                    top: 0;
                                    transform: none;
                                    -webkit-transform: none;
                                }
                            </style><div class="vc_column_inner tdi_20_eec  wpb_column vc_column_container tdc-inner-column td-pb-span12">
                                <style scoped>

                                    /* custom css */
                                    .tdi_20_eec{
                                        vertical-align: baseline;
                                    }
                                </style>
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                            {!! widget('frontend.widget.blog._section_widget_2') !!}

                                <!-- ./block --></div></div></div><div class="vc_column_inner tdi_23_8ee  wpb_column vc_column_container tdc-inner-column td-pb-span12">
                                <style scoped>

                                    /* custom css */
                                    .tdi_23_8ee{
                                        vertical-align: baseline;
                                    }
                                </style><div class="vc_column-inner"><div class="wpb_wrapper"></div></div></div></div></div></div></div></div>
{{--<div id="tdi_24_710" class="tdc-row">--}}
{{--    <div class="vc_row tdi_25_411  wpb_row td-pb-row" >--}}
{{--                <style scoped>--}}

{{--                    /* custom css */--}}
{{--                    .tdi_25_411{--}}
{{--                        min-height: 0;--}}
{{--                    }--}}
{{--                </style><div class="vc_column tdi_27_deb  wpb_column vc_column_container tdc-column td-pb-span12">--}}
{{--                    <style scoped>--}}

{{--                        /* custom css */--}}
{{--                        .tdi_27_deb{--}}
{{--                            vertical-align: baseline;--}}
{{--                        }--}}
{{--                    </style><div class="wpb_wrapper"></div></div></div></div>                </div>--}}
{{--</div>--}}
{{--@include('frontend.layouts.includes.footer_news')--}}
@endsection

