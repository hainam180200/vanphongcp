<div class="td-main-content-wrap td-container-wrap">
    <div class="td-container td-post-template-13">
        <article id="post-151171" class="post-151171 post type-post status-publish format-standard has-post-thumbnail category-featured category-khuyen-mai category-tin-hot category-tin-tuc category-tin-tuc-cong-nghe category-tin-vui tag-cuoc-thi-hoang-ha-mobile tag-tet-2022 tag-tiktok tag-tiktok-master-hoang-ha-mobile" itemscope itemtype="http://schema.org/Article">
            <div class="td-pb-row">
                <div class="td-pb-span12">
                    <div class="td-post-header">
                        <div class="td-crumb-container"></div>


                        <header class="td-post-title">
                            @if(isset($data->groups) && count($data->groups) > 0)

                                <ul class="td-category">
                                    @foreach($data->groups as $group_item)
                                        <li class="entry-category"><a  href="/blog{{isset($group_item->url) ? $group_item->url : $group_item->slug}}">{{$group_item->title}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                            {{--                                <ul class="td-category">--}}
                            {{--                                    <li class="entry-category"><a  href="">Khuyến Mãi</a></li><li class="entry-category"><a  href="">Tin hot</a></li><li class="entry-category"><a  href="">Tin tức</a></li><li class="entry-category"><a  href="">Tin tức công nghệ</a></li><li class="entry-category"><a  href="">Tin vui</a></li>--}}
                            {{--                                </ul>              --}}
                            <h1 class="entry-title">
                                {{ isset($data->title)?$data->title:'' }}

                            </h1>



                            <div class="td-module-meta-info">
                                <div class="td-post-author-name"><div class="td-author-by">Bởi</div> <a href="">Le Thu</a><div class="td-author-line"> - </div> </div>                                <span class="td-post-date"><time class="entry-date updated td-module-date" >14 Tháng Một, 2022</time></span>                                <div class="td-post-views"><i class="fas fa-eye"></i> <span class="td-nr-views-151171">39</span></div>                                <div class="td-post-comments"><a href=""><i class="fas fa-comments"></i> 0</a></div>
                            </div>

                        </header>

                        {{--                            <div class="td-post-sharing-top"><div id="td_social_sharing_article_top" class="td-post-sharing td-ps-bg td-ps-notext td-post-sharing-style1 "><div class="td-post-sharing-visible"><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-facebook" href="">--}}
                        {{--                                            <div class="td-social-but-icon"><i class="fab fa-facebook-square"></i></div>--}}
                        {{--                                            <div class="td-social-but-text">Facebook</div>--}}
                        {{--                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-twitter" href="">--}}
                        {{--                                            <div class="td-social-but-icon"><i class="fab fa-twitter"></i></div>--}}
                        {{--                                            <div class="td-social-but-text">Twitter</div>--}}
                        {{--                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-pinterest" href="">--}}
                        {{--                                            <div class="td-social-but-icon"><i class="fab fa-pinterest"></i></div>--}}
                        {{--                                            <div class="td-social-but-text">Pinterest</div>--}}
                        {{--                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-whatsapp" href="">--}}
                        {{--                                            <div class="td-social-but-icon"><i class="fab fa-whatsapp"></i></div>--}}
                        {{--                                            <div class="td-social-but-text">WhatsApp</div>--}}
                        {{--                                        </a></div><div class="td-social-sharing-hidden"><ul class="td-pulldown-filter-list"></ul><a class="td-social-sharing-button td-social-handler td-social-expand-tabs" href="#" data-block-uid="td_social_sharing_article_top">--}}
                        {{--                                            <div class="td-social-but-icon"><i class="td-icon-plus td-social-expand-tabs-icon"></i></div>--}}
                        {{--                                        </a></div></div></div>    --}}
                    </div>
                </div>
            </div> <!-- /.td-pb-row -->

            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content" role="main">
                    <div class="td-ss-main-content">
                        <div class="td-post-featured-image"><a href="" data-caption=""><img width="696" height="364" class="entry-thumb td-modal-image" src="  {{ isset($data->image)?\App\Library\Files::media($data->image) : null }}" srcset="  {{ isset($data->image)?\App\Library\Files::media($data->image) : null }} 696w,   {{ isset($data->image)?\App\Library\Files::media($data->image) : null }} 300w,   {{ isset($data->image)?\App\Library\Files::media($data->image) : null }} 1024w,   {{ isset($data->image)?\App\Library\Files::media($data->image) : null }} 768w,   {{ isset($data->image)?\App\Library\Files::media($data->image) : null }} 1068w,   {{ isset($data->image)?\App\Library\Files::media($data->image) : null }} 803w,   {{ isset($data->image)?\App\Library\Files::media($data->image) : null }} 1200w" sizes="(max-width: 696px) 100vw, 696px" alt="tiktok-hoanghamobile-anh-thumb" title="tiktok-hoanghamobile-anh-thumb"/></a></div>

                        <div class="td-post-content tagdiv-type">

                            {!! isset($data->content)?$data->content:'' !!}
                        </div>

                        <footer>



                            <div class="td_block_wrap td_block_related_posts tdi_4_551 td_with_ajax_pagination td-pb-border-top td_block_template_1"  data-td-block-uid="tdi_4_551" ><script>var block_tdi_4_551 = new tdBlock();
                                    block_tdi_4_551.id = "tdi_4_551";
                                    block_tdi_4_551.atts = '{"limit":6,"ajax_pagination":"next_prev","live_filter":"cur_post_same_categories","td_ajax_filter_type":"td_custom_related","class":"tdi_4_551","td_column_number":3,"live_filter_cur_post_id":151171,"live_filter_cur_post_author":"51","block_template_id":"","header_color":"","ajax_pagination_infinite_stop":"","offset":"","td_ajax_preloading":"","td_filter_default_txt":"","td_ajax_filter_ids":"","el_class":"","color_preset":"","border_top":"","css":"","tdc_css":"","tdc_css_class":"tdi_4_551","tdc_css_class_style":"tdi_4_551_rand_style"}';
                                    block_tdi_4_551.td_column_number = "3";
                                    block_tdi_4_551.block_type = "td_block_related_posts";
                                    block_tdi_4_551.post_count = "6";
                                    block_tdi_4_551.found_posts = "11430";
                                    block_tdi_4_551.header_color = "";
                                    block_tdi_4_551.ajax_pagination_infinite_stop = "";
                                    block_tdi_4_551.max_num_pages = "1905";
                                    tdBlocksArray.push(block_tdi_4_551);
                                </script>
                            </div>
                        {{--                                <h4 class="td-related-title td-block-title"><a id="tdi_5_6ef" class="td-related-left td-cur-simple-item" data-td_filter_value="" data-td_block_id="tdi_4_551" href="#">BÀI VIẾT LIÊN QUAN</a><a id="tdi_6_112" class="td-related-right" data-td_filter_value="td_related_more_from_author" data-td_block_id="tdi_4_551" href="#">XEM THÊM</a></h4><div id=tdi_4_551 class="td_block_inner">--}}

                        {{--                                    <div class="td-related-row">--}}

                        {{--                                        <div class="td-related-span4">--}}

                        {{--                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">--}}
                        {{--                                                <div class="td-module-image">--}}
                        {{--                                                    <div class="td-module-thumb"><a href="" rel="bookmark" class="td-image-wrap" title="Xiaomi MIX 5 trong concept mới nhất: Cụm camera siêu to khổng lồ tích hợp màn hình phụ phía sau"><img width="218" height="150" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/concept-xiaomi-mix-5-1-218x150.png"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/concept-xiaomi-mix-5-1-218x150.png 218w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/concept-xiaomi-mix-5-1-100x70.png 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="concept-xiaomi-mix-5-1" title="Xiaomi MIX 5 trong concept mới nhất: Cụm camera siêu to khổng lồ tích hợp màn hình phụ phía sau" /></a></div>                            </div>--}}
                        {{--                                                <div class="item-details">--}}
                        {{--                                                    <h3 class="entry-title td-module-title"><a href="" rel="bookmark" title="Xiaomi MIX 5 trong concept mới nhất: Cụm camera siêu to khổng lồ tích hợp màn hình phụ phía sau">Xiaomi MIX 5 trong concept mới nhất: Cụm camera siêu to khổng lồ tích hợp màn hình phụ phía sau</a></h3>            </div>--}}
                        {{--                                            </div>--}}

                        {{--                                        </div> <!-- ./td-related-span4 -->--}}

                        {{--                                        <div class="td-related-span4">--}}

                        {{--                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">--}}
                        {{--                                                <div class="td-module-image">--}}
                        {{--                                                    <div class="td-module-thumb"><a href="" rel="bookmark" class="td-image-wrap" title="Rò rỉ thiết kế và thông số kỹ thuật của Vivo Y21e: Snapdragon 680, pin 5000mAh"><img width="218" height="150" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-1-218x150.png"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-1-218x150.png 218w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-1-100x70.png 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="Vivo-Y21e" title="Rò rỉ thiết kế và thông số kỹ thuật của Vivo Y21e: Snapdragon 680, pin 5000mAh" /></a></div>                            </div>--}}
                        {{--                                                <div class="item-details">--}}
                        {{--                                                    <h3 class="entry-title td-module-title"><a href="" rel="bookmark" title="Rò rỉ thiết kế và thông số kỹ thuật của Vivo Y21e: Snapdragon 680, pin 5000mAh">Rò rỉ thiết kế và thông số kỹ thuật của Vivo Y21e: Snapdragon 680, pin 5000mAh</a></h3>            </div>--}}
                        {{--                                            </div>--}}

                        {{--                                        </div> <!-- ./td-related-span4 -->--}}

                        {{--                                        <div class="td-related-span4">--}}

                        {{--                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">--}}
                        {{--                                                <div class="td-module-image">--}}
                        {{--                                                    <div class="td-module-thumb"><a href="" rel="bookmark" class="td-image-wrap" title="Galaxy S22 và Galaxy S22 Ultra vừa đạt thêm một chứng nhận quan trọng trước khi lên kệ toàn thế giới"><img width="218" height="150" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-218x150.png"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-218x150.png 218w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-100x70.png 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="Samsung-Galaxy-S22-Ultra" title="Galaxy S22 và Galaxy S22 Ultra vừa đạt thêm một chứng nhận quan trọng trước khi lên kệ toàn thế giới" /></a></div>                            </div>--}}
                        {{--                                                <div class="item-details">--}}
                        {{--                                                    <h3 class="entry-title td-module-title"><a href="" rel="bookmark" title="Galaxy S22 và Galaxy S22 Ultra vừa đạt thêm một chứng nhận quan trọng trước khi lên kệ toàn thế giới">Galaxy S22 và Galaxy S22 Ultra vừa đạt thêm một chứng nhận quan trọng trước khi lên kệ toàn thế giới</a></h3>            </div>--}}
                        {{--                                            </div>--}}

                        {{--                                        </div> <!-- ./td-related-span4 --></div><!--./row-fluid-->--}}

                        {{--                                    <div class="td-related-row">--}}

                        {{--                                        <div class="td-related-span4">--}}

                        {{--                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">--}}
                        {{--                                                <div class="td-module-image">--}}
                        {{--                                                    <div class="td-module-thumb"><a href="" rel="bookmark" class="td-image-wrap" title="Galaxy Z Flip3 5G sắp gặp &#8220;đối thủ đáng gờm&#8221; đến từ Motorola trên thị trường smartphone màn hình gập"><img width="218" height="150" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/razr-2020-a-218x150.jpeg"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/razr-2020-a-218x150.jpeg 218w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/razr-2020-a-100x70.jpeg 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="razr-2020-a" title="Galaxy Z Flip3 5G sắp gặp &#8220;đối thủ đáng gờm&#8221; đến từ Motorola trên thị trường smartphone màn hình gập" /></a></div>                            </div>--}}
                        {{--                                                <div class="item-details">--}}
                        {{--                                                    <h3 class="entry-title td-module-title"><a href="" rel="bookmark" title="Galaxy Z Flip3 5G sắp gặp &#8220;đối thủ đáng gờm&#8221; đến từ Motorola trên thị trường smartphone màn hình gập">Galaxy Z Flip3 5G sắp gặp &#8220;đối thủ đáng gờm&#8221; đến từ Motorola trên thị trường smartphone màn hình gập</a></h3>            </div>--}}
                        {{--                                            </div>--}}

                        {{--                                        </div> <!-- ./td-related-span4 -->--}}

                        {{--                                        <div class="td-related-span4">--}}

                        {{--                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">--}}
                        {{--                                                <div class="td-module-image">--}}
                        {{--                                                    <div class="td-module-thumb"><a href="" rel="bookmark" class="td-image-wrap" title="Đánh giá nhanh Motorola Pulse Bass 200 Wired: Tốt nhất phân khúc giá rẻ?"><img width="218" height="150" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/Hoang-Ha-Mobile-2-3-218x150.png"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/Hoang-Ha-Mobile-2-3-218x150.png 218w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/Hoang-Ha-Mobile-2-3-100x70.png 100w" sizes="(max-width: 218px) 100vw, 218px"  alt=" Mobile (2)" title="Đánh giá nhanh Motorola Pulse Bass 200 Wired: Tốt nhất phân khúc giá rẻ?" /></a></div>                            </div>--}}
                        {{--                                                <div class="item-details">--}}
                        {{--                                                    <h3 class="entry-title td-module-title"><a href="" rel="bookmark" title="Đánh giá nhanh Motorola Pulse Bass 200 Wired: Tốt nhất phân khúc giá rẻ?">Đánh giá nhanh Motorola Pulse Bass 200 Wired: Tốt nhất phân khúc giá rẻ?</a></h3>            </div>--}}
                        {{--                                            </div>--}}

                        {{--                                        </div> <!-- ./td-related-span4 -->--}}

                        {{--                                        <div class="td-related-span4">--}}

                        {{--                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">--}}
                        {{--                                                <div class="td-module-image">--}}
                        {{--                                                    <div class="td-module-thumb"><a href="" rel="bookmark" class="td-image-wrap" title="Rò rỉ ảnh render sắc nét với cụm camera mới mẻ và thông số kĩ thuật của Realme 9 Pro"><img width="218" height="150" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/Realme-9-Pro-Render-1-e1642131271545-218x150.jpeg"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/Realme-9-Pro-Render-1-e1642131271545-218x150.jpeg 218w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/Realme-9-Pro-Render-1-e1642131271545-100x70.jpeg 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="Realme-9-Pro-Render-1" title="Rò rỉ ảnh render sắc nét với cụm camera mới mẻ và thông số kĩ thuật của Realme 9 Pro" /></a></div>                            </div>--}}
                        {{--                                                <div class="item-details">--}}
                        {{--                                                    <h3 class="entry-title td-module-title"><a href="" rel="bookmark" title="Rò rỉ ảnh render sắc nét với cụm camera mới mẻ và thông số kĩ thuật của Realme 9 Pro">Rò rỉ ảnh render sắc nét với cụm camera mới mẻ và thông số kĩ thuật của Realme 9 Pro</a></h3>            </div>--}}
                        {{--                                            </div>--}}

                        {{--                                        </div> <!-- ./td-related-span4 --></div><!--./row-fluid--></div><div class="td-next-prev-wrap"><a href="#" class="td-ajax-prev-page ajax-page-disabled" id="prev-page-tdi_4_551" data-td_block_id="tdi_4_551"><i class="fas fa-chevron-left"></i></a><a href="#"  class="td-ajax-next-page" id="next-page-tdi_4_551" data-td_block_id="tdi_4_551"><i class="fas fa-chevron-right"></i></a></div></div> <!-- ./block -->--}}
                    </div>
                </div>
            </div>
        {{--                    <div class="td-pb-span4 td-main-sidebar" role="complementary">--}}
        {{--                        <div class="td-ss-main-sidebar">--}}
        {{--                            <div class="td_block_wrap td_block_2 td_block_widget tdi_7_c7e td-pb-border-top td_block_template_1 td-column-1 td_block_padding"  data-td-block-uid="tdi_7_c7e" ><script>var block_tdi_7_c7e = new tdBlock();--}}
        {{--                                    block_tdi_7_c7e.id = "tdi_7_c7e";--}}
        {{--                                    block_tdi_7_c7e.atts = '{"custom_title":"B\u00c0I VI\u1ebeT M\u1edaI","custom_url":"","block_template_id":"","header_color":"#","header_text_color":"#","limit":"5","offset":"","post_ids":"","category_id":"","category_ids":"","tag_slug":"","autors_id":"","installed_post_types":"","sort":"","td_ajax_filter_type":"","td_ajax_filter_ids":"","td_filter_default_txt":"All","td_ajax_preloading":"","ajax_pagination":"","ajax_pagination_infinite_stop":"","class":"td_block_widget tdi_7_c7e","separator":"","m2_tl":"","m2_el":"","m6_tl":"","show_modified_date":"","el_class":"","f_header_font_header":"","f_header_font_title":"Block header","f_header_font_settings":"","f_header_font_family":"","f_header_font_size":"","f_header_font_line_height":"","f_header_font_style":"","f_header_font_weight":"","f_header_font_transform":"","f_header_font_spacing":"","f_header_":"","f_ajax_font_title":"Ajax categories","f_ajax_font_settings":"","f_ajax_font_family":"","f_ajax_font_size":"","f_ajax_font_line_height":"","f_ajax_font_style":"","f_ajax_font_weight":"","f_ajax_font_transform":"","f_ajax_font_spacing":"","f_ajax_":"","f_more_font_title":"Load more button","f_more_font_settings":"","f_more_font_family":"","f_more_font_size":"","f_more_font_line_height":"","f_more_font_style":"","f_more_font_weight":"","f_more_font_transform":"","f_more_font_spacing":"","f_more_":"","m2f_title_font_header":"","m2f_title_font_title":"Article title","m2f_title_font_settings":"","m2f_title_font_family":"","m2f_title_font_size":"","m2f_title_font_line_height":"","m2f_title_font_style":"","m2f_title_font_weight":"","m2f_title_font_transform":"","m2f_title_font_spacing":"","m2f_title_":"","m2f_cat_font_title":"Article category tag","m2f_cat_font_settings":"","m2f_cat_font_family":"","m2f_cat_font_size":"","m2f_cat_font_line_height":"","m2f_cat_font_style":"","m2f_cat_font_weight":"","m2f_cat_font_transform":"","m2f_cat_font_spacing":"","m2f_cat_":"","m2f_meta_font_title":"Article meta info","m2f_meta_font_settings":"","m2f_meta_font_family":"","m2f_meta_font_size":"","m2f_meta_font_line_height":"","m2f_meta_font_style":"","m2f_meta_font_weight":"","m2f_meta_font_transform":"","m2f_meta_font_spacing":"","m2f_meta_":"","m2f_ex_font_title":"Article excerpt","m2f_ex_font_settings":"","m2f_ex_font_family":"","m2f_ex_font_size":"","m2f_ex_font_line_height":"","m2f_ex_font_style":"","m2f_ex_font_weight":"","m2f_ex_font_transform":"","m2f_ex_font_spacing":"","m2f_ex_":"","m6f_title_font_header":"","m6f_title_font_title":"Article title","m6f_title_font_settings":"","m6f_title_font_family":"","m6f_title_font_size":"","m6f_title_font_line_height":"","m6f_title_font_style":"","m6f_title_font_weight":"","m6f_title_font_transform":"","m6f_title_font_spacing":"","m6f_title_":"","m6f_cat_font_title":"Article category tag","m6f_cat_font_settings":"","m6f_cat_font_family":"","m6f_cat_font_size":"","m6f_cat_font_line_height":"","m6f_cat_font_style":"","m6f_cat_font_weight":"","m6f_cat_font_transform":"","m6f_cat_font_spacing":"","m6f_cat_":"","m6f_meta_font_title":"Article meta info","m6f_meta_font_settings":"","m6f_meta_font_family":"","m6f_meta_font_size":"","m6f_meta_font_line_height":"","m6f_meta_font_style":"","m6f_meta_font_weight":"","m6f_meta_font_transform":"","m6f_meta_font_spacing":"","m6f_meta_":"","css":"","tdc_css":"","td_column_number":1,"color_preset":"","border_top":"","tdc_css_class":"tdi_7_c7e","tdc_css_class_style":"tdi_7_c7e_rand_style"}';--}}
        {{--                                    block_tdi_7_c7e.td_column_number = "1";--}}
        {{--                                    block_tdi_7_c7e.block_type = "td_block_2";--}}
        {{--                                    block_tdi_7_c7e.post_count = "5";--}}
        {{--                                    block_tdi_7_c7e.found_posts = "15205";--}}
        {{--                                    block_tdi_7_c7e.header_color = "#";--}}
        {{--                                    block_tdi_7_c7e.ajax_pagination_infinite_stop = "";--}}
        {{--                                    block_tdi_7_c7e.max_num_pages = "3041";--}}
        {{--                                    tdBlocksArray.push(block_tdi_7_c7e);--}}
        {{--                                </script><div class="td-block-title-wrap"><h4 class="block-title td-block-title"><span class="td-pulldown-size">BÀI VIẾT MỚI</span></h4></div><div id=tdi_7_c7e class="td_block_inner">--}}

        {{--                                    <div class="td-block-span12">--}}

        {{--                                        <div class="td_module_2 td_module_wrap td-animation-stack">--}}
        {{--                                            <div class="td-module-image">--}}
        {{--                                                <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/xiaomi-mix-5-trong-concept-moi-nhat-cum-camera-sieu-to-khong-lo-tich-hop-man-hinh-phu-phia-sau" rel="bookmark" class="td-image-wrap" title="Xiaomi MIX 5 trong concept mới nhất: Cụm camera siêu to khổng lồ tích hợp màn hình phụ phía sau"><img width="324" height="160" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/concept-xiaomi-mix-5-1-324x160.png"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/concept-xiaomi-mix-5-1-324x160.png 324w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/concept-xiaomi-mix-5-1-533x261.png 533w" sizes="(max-width: 324px) 100vw, 324px"  alt="concept-xiaomi-mix-5-1" title="Xiaomi MIX 5 trong concept mới nhất: Cụm camera siêu to khổng lồ tích hợp màn hình phụ phía sau" /></a></div>                <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>            </div>--}}
        {{--                                            <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/xiaomi-mix-5-trong-concept-moi-nhat-cum-camera-sieu-to-khong-lo-tich-hop-man-hinh-phu-phia-sau" rel="bookmark" title="Xiaomi MIX 5 trong concept mới nhất: Cụm camera siêu to khổng lồ tích hợp màn hình phụ phía sau">Xiaomi MIX 5 trong concept mới nhất: Cụm camera siêu to...</a></h3>--}}

        {{--                                            <div class="td-module-meta-info">--}}
        {{--                                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-01-14T16:44:57+00:00" >14 Tháng Một, 2022</time></span>                            </div>--}}


        {{--                                            <div class="td-excerpt">--}}
        {{--                                                Sau nhiều năm tạm dừng, Xiaomi đã tiếp tục giới thiệu dòng Mi MIX thế hệ mới là Mi MIX 4 vào tháng 8/2021....            </div>--}}


        {{--                                        </div>--}}


        {{--                                    </div> <!-- ./td-block-span12 -->--}}

        {{--                                    <div class="td-block-span12">--}}

        {{--                                        <div class="td_module_6 td_module_wrap td-animation-stack">--}}

        {{--                                            <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/ro-ri-thiet-ke-va-thong-so-ky-thuat-cua-vivo-y21e-snapdragon-680-pin-5000mah" rel="bookmark" class="td-image-wrap" title="Rò rỉ thiết kế và thông số kỹ thuật của Vivo Y21e: Snapdragon 680, pin 5000mAh"><img width="100" height="70" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-1-100x70.png"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-1-100x70.png 100w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-1-218x150.png 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="Vivo-Y21e" title="Rò rỉ thiết kế và thông số kỹ thuật của Vivo Y21e: Snapdragon 680, pin 5000mAh" /></a></div>--}}
        {{--                                            <div class="item-details">--}}
        {{--                                                <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/ro-ri-thiet-ke-va-thong-so-ky-thuat-cua-vivo-y21e-snapdragon-680-pin-5000mah" rel="bookmark" title="Rò rỉ thiết kế và thông số kỹ thuật của Vivo Y21e: Snapdragon 680, pin 5000mAh">Rò rỉ thiết kế và thông số kỹ thuật của Vivo...</a></h3>            <div class="td-module-meta-info">--}}
        {{--                                                    <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-01-14T16:31:19+00:00" >14 Tháng Một, 2022</time></span>                            </div>--}}
        {{--                                            </div>--}}

        {{--                                        </div>--}}


        {{--                                    </div> <!-- ./td-block-span12 -->--}}

        {{--                                    <div class="td-block-span12">--}}

        {{--                                        <div class="td_module_6 td_module_wrap td-animation-stack">--}}

        {{--                                            <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/galaxy-s22-va-galaxy-s22-ultra-vua-dat-them-mot-chung-nhan-quan-trong" rel="bookmark" class="td-image-wrap" title="Galaxy S22 và Galaxy S22 Ultra vừa đạt thêm một chứng nhận quan trọng trước khi lên kệ toàn thế giới"><img width="100" height="70" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-100x70.png"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-100x70.png 100w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/1401-218x150.png 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="Samsung-Galaxy-S22-Ultra" title="Galaxy S22 và Galaxy S22 Ultra vừa đạt thêm một chứng nhận quan trọng trước khi lên kệ toàn thế giới" /></a></div>--}}
        {{--                                            <div class="item-details">--}}
        {{--                                                <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/galaxy-s22-va-galaxy-s22-ultra-vua-dat-them-mot-chung-nhan-quan-trong" rel="bookmark" title="Galaxy S22 và Galaxy S22 Ultra vừa đạt thêm một chứng nhận quan trọng trước khi lên kệ toàn thế giới">Galaxy S22 và Galaxy S22 Ultra vừa đạt thêm một chứng...</a></h3>            <div class="td-module-meta-info">--}}
        {{--                                                    <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-01-14T16:22:54+00:00" >14 Tháng Một, 2022</time></span>                            </div>--}}
        {{--                                            </div>--}}

        {{--                                        </div>--}}


        {{--                                    </div> <!-- ./td-block-span12 -->--}}

        {{--                                    <div class="td-block-span12">--}}

        {{--                                        <div class="td_module_6 td_module_wrap td-animation-stack">--}}

        {{--                                            <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/galaxy-z-flip3-5g-sap-gap-doi-thu-dang-gom-den-tu-motorola-tren-thi-truong-smartphone-man-hinh-gap" rel="bookmark" class="td-image-wrap" title="Galaxy Z Flip3 5G sắp gặp &#8220;đối thủ đáng gờm&#8221; đến từ Motorola trên thị trường smartphone màn hình gập"><img width="100" height="70" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/razr-2020-a-100x70.jpeg"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/razr-2020-a-100x70.jpeg 100w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/razr-2020-a-218x150.jpeg 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="razr-2020-a" title="Galaxy Z Flip3 5G sắp gặp &#8220;đối thủ đáng gờm&#8221; đến từ Motorola trên thị trường smartphone màn hình gập" /></a></div>--}}
        {{--                                            <div class="item-details">--}}
        {{--                                                <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/galaxy-z-flip3-5g-sap-gap-doi-thu-dang-gom-den-tu-motorola-tren-thi-truong-smartphone-man-hinh-gap" rel="bookmark" title="Galaxy Z Flip3 5G sắp gặp &#8220;đối thủ đáng gờm&#8221; đến từ Motorola trên thị trường smartphone màn hình gập">Galaxy Z Flip3 5G sắp gặp &#8220;đối thủ đáng gờm&#8221; đến...</a></h3>            <div class="td-module-meta-info">--}}
        {{--                                                    <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-01-14T16:00:06+00:00" >14 Tháng Một, 2022</time></span>                            </div>--}}
        {{--                                            </div>--}}

        {{--                                        </div>--}}


        {{--                                    </div> <!-- ./td-block-span12 -->--}}

        {{--                                    <div class="td-block-span12">--}}

        {{--                                        <div class="td_module_6 td_module_wrap td-animation-stack">--}}

        {{--                                            <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/danh-gia-nhanh-motorola-pulse-bass-200-wired" rel="bookmark" class="td-image-wrap" title="Đánh giá nhanh Motorola Pulse Bass 200 Wired: Tốt nhất phân khúc giá rẻ?"><img width="100" height="70" class="entry-thumb" src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/Hoang-Ha-Mobile-2-3-100x70.png"  srcset="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/Hoang-Ha-Mobile-2-3-100x70.png 100w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2022/01/Hoang-Ha-Mobile-2-3-218x150.png 218w" sizes="(max-width: 100px) 100vw, 100px"  alt=" Mobile (2)" title="Đánh giá nhanh Motorola Pulse Bass 200 Wired: Tốt nhất phân khúc giá rẻ?" /></a></div>--}}
        {{--                                            <div class="item-details">--}}
        {{--                                                <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/danh-gia-nhanh-motorola-pulse-bass-200-wired" rel="bookmark" title="Đánh giá nhanh Motorola Pulse Bass 200 Wired: Tốt nhất phân khúc giá rẻ?">Đánh giá nhanh Motorola Pulse Bass 200 Wired: Tốt nhất phân...</a></h3>            <div class="td-module-meta-info">--}}
        {{--                                                    <a href="https://hoanghamobile.com/tin-tuc/category/danh-gia-phu-kien" class="td-post-category">Đánh giá phụ kiện</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-01-14T14:19:24+00:00" >14 Tháng Một, 2022</time></span>                            </div>--}}
        {{--                                            </div>--}}

        {{--                                        </div>--}}


        {{--                                    </div> <!-- ./td-block-span12 --></div></div> <!-- ./block -->                                </div>--}}
        {{--                    </div>--}}
    </div> <!-- /.td-pb-row -->
    </article> <!-- /.post -->
</div> <!-- /.td-container -->
</div>
