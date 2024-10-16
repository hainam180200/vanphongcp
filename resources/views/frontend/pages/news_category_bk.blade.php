
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
    <!-- subcategory -->
{{--    <div class="td-category-header td-container-wrap">--}}
{{--        <div class="td-container">--}}
{{--            <div class="td-pb-row">--}}
{{--                <div class="td-pb-span12">--}}

{{--                    <div class="td-crumb-container"></div>--}}
{{--                    <h1 class="entry-title td-page-title">Khuyến Mãi</h1>--}}
{{--                    <div class="td-category-siblings"><ul class="td-category"><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/khong-phan-loai">Chưa được phân loại</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/danh-gia">Đánh giá</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/danh-gia-phu-kien">Đánh giá phụ kiện</a></li><li class="entry-category"><a  class="td-current-sub-category"  href="https://hoanghamobile.com/tin-tuc/category/khuyen-mai">Khuyến Mãi</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/phu%cc%a3-kie%cc%a3n-hay">Phụ kiện hay</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/sa%cc%89n-pha%cc%89m-moi">Sản phẩm mới</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/thu-thuat">Thủ thuật</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/tin-tuc">Tin tức</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/tinh-nang-moi-tren-app">Tính năng mới trên app</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/trend">Trend</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/tu-van">Tư vấn</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/ung-dung-moi">Ứng dụng mới</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/video">Video</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/virtual-data-room">Virtual Data Room</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/write-my-essay-online">Write My Essay Online</a></li></ul><div class="td-subcat-dropdown td-pulldown-filter-display-option"><div class="td-subcat-more"><i class="td-icon-menu-down"></i></div><ul class="td-pulldown-filter-list"></ul></div><div class="clearfix"></div></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    @dd($breadcumb)--}}
    @if (isset($breadcumb) && count($breadcumb) > 0)
        @foreach ($breadcumb as $key => $item)

            <div class="td-category-header td-container-wrap">
                <div class="td-container">
                    <div class="td-pb-row">
                        <div class="td-pb-span12">

                            <div class="td-crumb-container"></div>
                            <h1 class="entry-title td-page-title">{{$item->title}}</h1>
{{--                            <div class="td-category-siblings"><ul class="td-category"><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/khong-phan-loai">Chưa được phân loại</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/danh-gia">Đánh giá</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/danh-gia-phu-kien">Đánh giá phụ kiện</a></li><li class="entry-category"><a  class="td-current-sub-category"  href="https://hoanghamobile.com/tin-tuc/category/khuyen-mai">Khuyến Mãi</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/phu%cc%a3-kie%cc%a3n-hay">Phụ kiện hay</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/sa%cc%89n-pha%cc%89m-moi">Sản phẩm mới</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/thu-thuat">Thủ thuật</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/tin-tuc">Tin tức</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/tinh-nang-moi-tren-app">Tính năng mới trên app</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/trend">Trend</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/tu-van">Tư vấn</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/ung-dung-moi">Ứng dụng mới</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/video">Video</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/virtual-data-room">Virtual Data Room</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/write-my-essay-online">Write My Essay Online</a></li></ul><div class="td-subcat-dropdown td-pulldown-filter-display-option"><div class="td-subcat-more"><i class="td-icon-menu-down"></i></div><ul class="td-pulldown-filter-list"></ul></div><div class="clearfix"></div></div>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="td-category-header td-container-wrap">
            <div class="td-container">
                <div class="td-pb-row">
                    <div class="td-pb-span12">

                        <div class="td-crumb-container"></div>
                        <h1 class="entry-title td-page-title">{{$data->title}}</h1>
                        {{--                            <div class="td-category-siblings"><ul class="td-category"><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/khong-phan-loai">Chưa được phân loại</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/danh-gia">Đánh giá</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/danh-gia-phu-kien">Đánh giá phụ kiện</a></li><li class="entry-category"><a  class="td-current-sub-category"  href="https://hoanghamobile.com/tin-tuc/category/khuyen-mai">Khuyến Mãi</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/phu%cc%a3-kie%cc%a3n-hay">Phụ kiện hay</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/sa%cc%89n-pha%cc%89m-moi">Sản phẩm mới</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/thu-thuat">Thủ thuật</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/tin-tuc">Tin tức</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/tinh-nang-moi-tren-app">Tính năng mới trên app</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/trend">Trend</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/tu-van">Tư vấn</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/ung-dung-moi">Ứng dụng mới</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/video">Video</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/virtual-data-room">Virtual Data Room</a></li><li class="entry-category"><a  class=""  href="https://hoanghamobile.com/tin-tuc/category/write-my-essay-online">Write My Essay Online</a></li></ul><div class="td-subcat-dropdown td-pulldown-filter-display-option"><div class="td-subcat-more"><i class="td-icon-menu-down"></i></div><ul class="td-pulldown-filter-list"></ul></div><div class="clearfix"></div></div>--}}
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- big grid -->
    <div class="td-category-grid td-container-wrap">
        <div class="td-container">
            <div class="td-pb-row">
                <div class="td-pb-span12">
                    <div class="td_block_wrap td_block_big_grid_12 tdi_2_c2a td-grid-style-1 td-hover-1 td-big-grids td-pb-border-top td_block_template_1"  data-td-block-uid="tdi_2_c2a" ><div id=tdi_2_c2a class="td_block_inner"><div class="td-big-grid-wrapper">
                                <div class="td_module_mx5 td-animation-stack td-big-grid-post-0 td-big-grid-post td-big-thumb">
                                    <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/uu-dai-ngap-tran-gui-ngan-loi-yeu-8-3-tham-gia-vong-quay-may-man-rinh-qua-khung-tong-tri-gia-hon-80-trieu" rel="bookmark" class="td-image-wrap" title="Ưu đãi ngập tràn &#8211; Gửi ngàn yêu thương 8/3: Tham gia vòng quay may mắn rinh quà khủng tổng trị giá hơn 80 triệu"><img width="534" height="462" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/1200x628-anh-vong-quay-01-534x462.jpg"   alt="1200&#215;628 ảnh vong quay-01" title="Ưu đãi ngập tràn &#8211; Gửi ngàn yêu thương 8/3: Tham gia vòng quay may mắn rinh quà khủng tổng trị giá hơn 80 triệu" /></a></div>            <div class="td-meta-info-container">
                                        <div class="td-meta-align">
                                            <div class="td-big-grid-meta">
                                                <a href="https://hoanghamobile.com/tin-tuc/category/khuyen-mai" class="td-post-category">Khuyến Mãi</a>                        <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/uu-dai-ngap-tran-gui-ngan-loi-yeu-8-3-tham-gia-vong-quay-may-man-rinh-qua-khung-tong-tri-gia-hon-80-trieu" rel="bookmark" title="Ưu đãi ngập tràn &#8211; Gửi ngàn yêu thương 8/3: Tham gia vòng quay may mắn rinh quà khủng tổng trị giá hơn 80 triệu">Ưu đãi ngập tràn &#8211; Gửi ngàn yêu thương 8/3: Tham gia vòng quay may mắn rinh quà khủng tổng trị giá hơn 80...</a></h3>                    </div>
                                            <div class="td-module-meta-info">
                                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-04T08:30:37+00:00" >4 Tháng Ba, 2022</time></span>                    </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="td_module_mx11 td-animation-stack td-big-grid-post-1 td-big-grid-post td-medium-thumb">
                                    <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/uu-dai-len-doi-de-yeu-tang-data-khung-cho-samsung-galaxy-a03" rel="bookmark" class="td-image-wrap" title="Ưu đãi khi mua Samsung Galaxy A03: Lên đời dế yêu &#8211; Tặng data khủng trong 6 tháng!"><img width="533" height="261" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/Hoang-Ha-Mobile-4-533x261.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/Hoang-Ha-Mobile-4-533x261.png 533w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/Hoang-Ha-Mobile-4-324x160.png 324w" sizes="(max-width: 533px) 100vw, 533px"  alt="Hoàng Hà Mobile A03" title="Ưu đãi khi mua Samsung Galaxy A03: Lên đời dế yêu &#8211; Tặng data khủng trong 6 tháng!" /></a></div>            <div class="td-meta-info-container">
                                        <div class="td-meta-align">
                                            <div class="td-big-grid-meta">
                                                <a href="https://hoanghamobile.com/tin-tuc/category/khuyen-mai" class="td-post-category">Khuyến Mãi</a>                        <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/uu-dai-len-doi-de-yeu-tang-data-khung-cho-samsung-galaxy-a03" rel="bookmark" title="Ưu đãi khi mua Samsung Galaxy A03: Lên đời dế yêu &#8211; Tặng data khủng trong 6 tháng!">Ưu đãi khi mua Samsung Galaxy A03: Lên đời dế yêu &#8211; Tặng data khủng trong 6 tháng!</a></h3>                    </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="td_module_mx11 td-animation-stack td-big-grid-post-2 td-big-grid-post td-medium-thumb">
                                    <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/gio-vang-dat-truoc-samsung-galaxy-s22-ultra" rel="bookmark" class="td-image-wrap" title="Giờ vàng đặt hàng Galaxy S22 Ultra, cơ hội sở hữu siêu phẩm chỉ với 22.222.222 đồng"><img width="533" height="261" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/s22-ultra-22tr-08-533x261.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/s22-ultra-22tr-08-533x261.png 533w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/s22-ultra-22tr-08-324x160.png 324w" sizes="(max-width: 533px) 100vw, 533px"  alt="s22 ultra 22tr-08" title="Giờ vàng đặt hàng Galaxy S22 Ultra, cơ hội sở hữu siêu phẩm chỉ với 22.222.222 đồng" /></a></div>            <div class="td-meta-info-container">
                                        <div class="td-meta-align">
                                            <div class="td-big-grid-meta">
                                                <a href="https://hoanghamobile.com/tin-tuc/category/khuyen-mai" class="td-post-category">Khuyến Mãi</a>                        <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/gio-vang-dat-truoc-samsung-galaxy-s22-ultra" rel="bookmark" title="Giờ vàng đặt hàng Galaxy S22 Ultra, cơ hội sở hữu siêu phẩm chỉ với 22.222.222 đồng">Giờ vàng đặt hàng Galaxy S22 Ultra, cơ hội sở hữu siêu phẩm chỉ với 22.222.222 đồng</a></h3>                    </div>
                                        </div>
                                    </div>

                                </div>

                            </div><div class="clearfix"></div></div></div> <!-- ./block -->					</div>
            </div>
        </div>
    </div>

    <div class="td-main-content-wrap td-container-wrap">
        <div class="td-container">

            <!-- content -->
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content">
                    <div class="td-ss-main-content">
                        <!-- module -->
                        @if (isset($items_prd) && count($items_prd) > 0)
                            @foreach ($items_prd as $item)
                        <div class="td_module_10 td_module_wrap td-animation-stack">
                            <div class="td-module-thumb"><a href="{{isset($item->url) ? $item->url : $item->slug}}" rel="bookmark" class="td-image-wrap" title="{{isset($item->title) ? $item->title : null}}"><img width="218" height="150" class="entry-thumb" src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}"  srcset="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }} 218w, {{ isset($item->image)?\App\Library\Files::media($item->image) : null }} 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="" title="{{isset($item->title) ? $item->title : null}}" /></a></div>
                            <div class="item-details">
                                <h3 class="entry-title td-module-title"><a href="{{isset($item->url) ? $item->url : $item->slug}}" rel="bookmark" title="{{isset($item->title) ? $item->title : null}}">{{isset($item->title) ? $item->title : null}}</a></h3>
                                <div class="td-module-meta-info">
                                    <a href="{{isset($data->url) ? $data->url : $data->slug}}" class="td-post-category">{{$data->title}}</a>
                                    <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-02-09T23:00:52+00:00" >9 Tháng Hai, 2022</time></span>                                        </div>

                                <div class="td-excerpt">
                                    {!! isset($item->description) ? $item->description : '' !!}
                                </div>
                            </div>

                        </div>
                        @endforeach
                    @endif
                        <!-- module -->


                        <div class="page-nav td-pb-padding-side"><span class="current">1</span><a href="2" class="page" title="2">2</a><a href="3" class="page" title="3">3</a><span class="extend">...</span><a href="61" class="last" title="61">61</a><a href="2" ><i class="td-icon-menu-right"></i></a><span class="pages">Trang 1 của 61</span><div class="clearfix"></div></div>                            </div>
                </div>

                <div class="td-pb-span4 td-main-sidebar">
                    <div class="td-ss-main-sidebar">
                        <div class="td_block_wrap td_block_2 td_block_widget tdi_3_233 td-pb-border-top td_block_template_1 td-column-1 td_block_padding"  data-td-block-uid="tdi_3_233" ><script>var block_tdi_3_233 = new tdBlock();
                                block_tdi_3_233.id = "tdi_3_233";
                                block_tdi_3_233.atts = '{"custom_title":"B\u00c0I VI\u1ebeT M\u1edaI","custom_url":"","block_template_id":"","header_color":"#","header_text_color":"#","limit":"5","offset":"","post_ids":"","category_id":"","category_ids":"","tag_slug":"","autors_id":"","installed_post_types":"","sort":"","td_ajax_filter_type":"","td_ajax_filter_ids":"","td_filter_default_txt":"All","td_ajax_preloading":"","ajax_pagination":"","ajax_pagination_infinite_stop":"","class":"td_block_widget tdi_3_233","separator":"","m2_tl":"","m2_el":"","m6_tl":"","show_modified_date":"","el_class":"","f_header_font_header":"","f_header_font_title":"Block header","f_header_font_settings":"","f_header_font_family":"","f_header_font_size":"","f_header_font_line_height":"","f_header_font_style":"","f_header_font_weight":"","f_header_font_transform":"","f_header_font_spacing":"","f_header_":"","f_ajax_font_title":"Ajax categories","f_ajax_font_settings":"","f_ajax_font_family":"","f_ajax_font_size":"","f_ajax_font_line_height":"","f_ajax_font_style":"","f_ajax_font_weight":"","f_ajax_font_transform":"","f_ajax_font_spacing":"","f_ajax_":"","f_more_font_title":"Load more button","f_more_font_settings":"","f_more_font_family":"","f_more_font_size":"","f_more_font_line_height":"","f_more_font_style":"","f_more_font_weight":"","f_more_font_transform":"","f_more_font_spacing":"","f_more_":"","m2f_title_font_header":"","m2f_title_font_title":"Article title","m2f_title_font_settings":"","m2f_title_font_family":"","m2f_title_font_size":"","m2f_title_font_line_height":"","m2f_title_font_style":"","m2f_title_font_weight":"","m2f_title_font_transform":"","m2f_title_font_spacing":"","m2f_title_":"","m2f_cat_font_title":"Article category tag","m2f_cat_font_settings":"","m2f_cat_font_family":"","m2f_cat_font_size":"","m2f_cat_font_line_height":"","m2f_cat_font_style":"","m2f_cat_font_weight":"","m2f_cat_font_transform":"","m2f_cat_font_spacing":"","m2f_cat_":"","m2f_meta_font_title":"Article meta info","m2f_meta_font_settings":"","m2f_meta_font_family":"","m2f_meta_font_size":"","m2f_meta_font_line_height":"","m2f_meta_font_style":"","m2f_meta_font_weight":"","m2f_meta_font_transform":"","m2f_meta_font_spacing":"","m2f_meta_":"","m2f_ex_font_title":"Article excerpt","m2f_ex_font_settings":"","m2f_ex_font_family":"","m2f_ex_font_size":"","m2f_ex_font_line_height":"","m2f_ex_font_style":"","m2f_ex_font_weight":"","m2f_ex_font_transform":"","m2f_ex_font_spacing":"","m2f_ex_":"","m6f_title_font_header":"","m6f_title_font_title":"Article title","m6f_title_font_settings":"","m6f_title_font_family":"","m6f_title_font_size":"","m6f_title_font_line_height":"","m6f_title_font_style":"","m6f_title_font_weight":"","m6f_title_font_transform":"","m6f_title_font_spacing":"","m6f_title_":"","m6f_cat_font_title":"Article category tag","m6f_cat_font_settings":"","m6f_cat_font_family":"","m6f_cat_font_size":"","m6f_cat_font_line_height":"","m6f_cat_font_style":"","m6f_cat_font_weight":"","m6f_cat_font_transform":"","m6f_cat_font_spacing":"","m6f_cat_":"","m6f_meta_font_title":"Article meta info","m6f_meta_font_settings":"","m6f_meta_font_family":"","m6f_meta_font_size":"","m6f_meta_font_line_height":"","m6f_meta_font_style":"","m6f_meta_font_weight":"","m6f_meta_font_transform":"","m6f_meta_font_spacing":"","m6f_meta_":"","css":"","tdc_css":"","td_column_number":1,"color_preset":"","border_top":"","tdc_css_class":"tdi_3_233","tdc_css_class_style":"tdi_3_233_rand_style"}';
                                block_tdi_3_233.td_column_number = "1";
                                block_tdi_3_233.block_type = "td_block_2";
                                block_tdi_3_233.post_count = "5";
                                block_tdi_3_233.found_posts = "15702";
                                block_tdi_3_233.header_color = "#";
                                block_tdi_3_233.ajax_pagination_infinite_stop = "";
                                block_tdi_3_233.max_num_pages = "3141";
                                tdBlocksArray.push(block_tdi_3_233);
                            </script><div class="td-block-title-wrap"><h4 class="block-title td-block-title"><span class="td-pulldown-size">BÀI VIẾT MỚI</span></h4></div><div id=tdi_3_233 class="td_block_inner">

                                <div class="td-block-span12">

                                    <div class="td_module_2 td_module_wrap td-animation-stack">
                                        <div class="td-module-image">
                                            <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/so-sanh-ipad-air-2022-va-ipad-air-2020-co-nen-nang-cap-hay-khong" rel="bookmark" class="td-image-wrap" title="So sánh iPad Air 2022 và iPad Air 2020, có nên nâng cấp hay không?"><img width="324" height="160" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/so-sanh-ipad-air-2022-1-324x160.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/so-sanh-ipad-air-2022-1-324x160.png 324w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/so-sanh-ipad-air-2022-1-533x261.png 533w" sizes="(max-width: 324px) 100vw, 324px"  alt="so-sanh-ipad-air-2022-1" title="So sánh iPad Air 2022 và iPad Air 2020, có nên nâng cấp hay không?" /></a></div>                <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>            </div>
                                        <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/so-sanh-ipad-air-2022-va-ipad-air-2020-co-nen-nang-cap-hay-khong" rel="bookmark" title="So sánh iPad Air 2022 và iPad Air 2020, có nên nâng cấp hay không?">So sánh iPad Air 2022 và iPad Air 2020, có nên...</a></h3>

                                        <div class="td-module-meta-info">
                                            <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-12T11:17:40+00:00" >12 Tháng Ba, 2022</time></span>                            </div>


                                        <div class="td-excerpt">
                                            iPad vẫn được đánh giá là dòng máy tính bảng dẫn đầu thị trường với thiết kế đẹp, hiệu năng mạnh mẽ, pin trâu....            </div>


                                    </div>


                                </div> <!-- ./td-block-span12 -->

                                <div class="td-block-span12">

                                    <div class="td_module_6 td_module_wrap td-animation-stack">

                                        <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/apple-lam-ro-thoi-luong-pin-an-tuong-cua-iphone-se-3-da-co-su-cai-tien-so-voi-the-he-tien-nhiem" rel="bookmark" class="td-image-wrap" title="Apple làm rõ thời lượng pin ấn tượng của iPhone SE 3, đã có sự cải tiến so với thế hệ tiền nhiệm"><img width="100" height="70" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/thong-tin-iPhone-SE-3-100x70.jpg"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/thong-tin-iPhone-SE-3-100x70.jpg 100w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/thong-tin-iPhone-SE-3-218x150.jpg 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="thong-tin-iPhone-SE-3" title="Apple làm rõ thời lượng pin ấn tượng của iPhone SE 3, đã có sự cải tiến so với thế hệ tiền nhiệm" /></a></div>
                                        <div class="item-details">
                                            <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/apple-lam-ro-thoi-luong-pin-an-tuong-cua-iphone-se-3-da-co-su-cai-tien-so-voi-the-he-tien-nhiem" rel="bookmark" title="Apple làm rõ thời lượng pin ấn tượng của iPhone SE 3, đã có sự cải tiến so với thế hệ tiền nhiệm">Apple làm rõ thời lượng pin ấn tượng của iPhone SE...</a></h3>            <div class="td-module-meta-info">
                                                <a href="https://hoanghamobile.com/tin-tuc/category/sa%cc%89n-pha%cc%89m-moi" class="td-post-category">Sản phẩm mới</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-12T10:54:13+00:00" >12 Tháng Ba, 2022</time></span>                            </div>
                                        </div>

                                    </div>


                                </div> <!-- ./td-block-span12 -->

                                <div class="td-block-span12">

                                    <div class="td_module_6 td_module_wrap td-animation-stack">

                                        <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/samsung-tiep-tuc-lo-bang-sang-che-smartphone-sieu-doc-la-gap-truot-linh-hoat-co-the-mo-rong-100-man-hinh" rel="bookmark" class="td-image-wrap" title="Samsung tiếp tục lộ bằng sáng chế smartphone siêu độc lạ, gập trượt linh hoạt, có thể mở rộng 100% màn hình"><img width="100" height="70" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/smartphone-samsung-gap-truot-5-100x70.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/smartphone-samsung-gap-truot-5-100x70.png 100w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/smartphone-samsung-gap-truot-5-218x150.png 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="smartphone-samsung-gap-truot-5" title="Samsung tiếp tục lộ bằng sáng chế smartphone siêu độc lạ, gập trượt linh hoạt, có thể mở rộng 100% màn hình" /></a></div>
                                        <div class="item-details">
                                            <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/samsung-tiep-tuc-lo-bang-sang-che-smartphone-sieu-doc-la-gap-truot-linh-hoat-co-the-mo-rong-100-man-hinh" rel="bookmark" title="Samsung tiếp tục lộ bằng sáng chế smartphone siêu độc lạ, gập trượt linh hoạt, có thể mở rộng 100% màn hình">Samsung tiếp tục lộ bằng sáng chế smartphone siêu độc lạ,...</a></h3>            <div class="td-module-meta-info">
                                                <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-12T10:25:18+00:00" >12 Tháng Ba, 2022</time></span>                            </div>
                                        </div>

                                    </div>


                                </div> <!-- ./td-block-span12 -->

                                <div class="td-block-span12">

                                    <div class="td_module_6 td_module_wrap td-animation-stack">

                                        <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/apple-khong-co-ke-hoach-tung-ra-imac-man-hinh-27-inch-trong-tuong-lai-gan" rel="bookmark" class="td-image-wrap" title="Apple không có kế hoạch tung ra iMac màn hình 27 inch trong tương lai gần"><img width="100" height="70" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/imac-e1647053854834-100x70.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/imac-e1647053854834-100x70.png 100w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/imac-e1647053854834-218x150.png 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="imac" title="Apple không có kế hoạch tung ra iMac màn hình 27 inch trong tương lai gần" /></a></div>
                                        <div class="item-details">
                                            <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/apple-khong-co-ke-hoach-tung-ra-imac-man-hinh-27-inch-trong-tuong-lai-gan" rel="bookmark" title="Apple không có kế hoạch tung ra iMac màn hình 27 inch trong tương lai gần">Apple không có kế hoạch tung ra iMac màn hình 27...</a></h3>            <div class="td-module-meta-info">
                                                <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-12T10:02:04+00:00" >12 Tháng Ba, 2022</time></span>                            </div>
                                        </div>

                                    </div>


                                </div> <!-- ./td-block-span12 -->

                                <div class="td-block-span12">

                                    <div class="td_module_6 td_module_wrap td-animation-stack">

                                        <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/sony-xperia-ace-iii-ra-mat-voi-kich-thuoc-nho-be" rel="bookmark" class="td-image-wrap" title="iPhone 13 mini không cô đơn, Sony Xperia Ace III cũng sẽ &#8220;bé xíu&#8221; như vậy!"><img width="100" height="70" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/LI-Sony-Xperia-Ace-III-render-100x70.jpeg"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/LI-Sony-Xperia-Ace-III-render-100x70.jpeg 100w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/LI-Sony-Xperia-Ace-III-render-218x150.jpeg 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="LI Sony Xperia Ace III render" title="iPhone 13 mini không cô đơn, Sony Xperia Ace III cũng sẽ &#8220;bé xíu&#8221; như vậy!" /></a></div>
                                        <div class="item-details">
                                            <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/sony-xperia-ace-iii-ra-mat-voi-kich-thuoc-nho-be" rel="bookmark" title="iPhone 13 mini không cô đơn, Sony Xperia Ace III cũng sẽ &#8220;bé xíu&#8221; như vậy!">iPhone 13 mini không cô đơn, Sony Xperia Ace III cũng...</a></h3>            <div class="td-module-meta-info">
                                                <a href="https://hoanghamobile.com/tin-tuc/category/sa%cc%89n-pha%cc%89m-moi" class="td-post-category">Sản phẩm mới</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-12T09:57:14+00:00" >12 Tháng Ba, 2022</time></span>                            </div>
                                        </div>

                                    </div>


                                </div> <!-- ./td-block-span12 --></div></div> <!-- ./block -->                            </div>
                </div>
            </div> <!-- /.td-pb-row -->
        </div> <!-- /.td-container -->
    </div> <!-- /.td-main-content-wrap -->

@endsection
