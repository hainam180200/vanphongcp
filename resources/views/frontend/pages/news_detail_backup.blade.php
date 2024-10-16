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
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
@endpush
@section('content')
        <article id="post-59015" class="td-post-template-3 post-59015 post type-post status-publish format-standard has-post-thumbnail  td-container-wrap" itemscope itemtype="https://schema.org/Article">
            <div class="td-post-header td-container">
                <div class="td-crumb-container"></div>
                <div class="td-post-header-holder td-image-gradient">
                    <div class="td-post-featured-image">
                        <a href="/blog/{{ isset($data->url)?$data->url:$data->slug }}" data-caption="">
                            @if(isset($data->image) && $data->image!=null)
                            <img width="1068" height="601" class="entry-thumb td-modal-image" src="{{isset($data->image)?\App\Library\Files::media($data->image) : null }} 1068w, {{isset($data->image)?\App\Library\Files::media($data->image) : null }} 300w, {{isset($data->image)?\App\Library\Files::media($data->image) : null }} 768w, {{isset($data->image)?\App\Library\Files::media($data->image) : null }} 1024w, {{isset($data->image)?\App\Library\Files::media($data->image) : null }} 696w, {{isset($data->image)?\App\Library\Files::media($data->image) : null }} 747w, {{isset($data->image)?\App\Library\Files::media($data->image) : null }} 1280w" sizes="(max-width: 1068px) 100vw, 1068px" alt="{{isset($data->title) ? $data->title : null}}" title="{{isset($data->title) ? $data->title : null}}"/>
                            @else
                                <img width="1068" height="601" class="entry-thumb td-modal-image" src="https://scontent.fhan15-2.fna.fbcdn.net/v/t39.30808-6/277228020_3351653081747618_1482215020138082388_n.jpg?stp=dst-jpg_p526x296&_nc_cat=1&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=oSgdXQGyJiMAX_1dcii&_nc_oc=AQnHX_OG8qlYUu7Tsfj-C7iuqxZmLBQ-Zr7fCVTfdoReQlqDoVyL9-gvSwmTGTGj2Ld_98qEC_V_sjD-U4vcG7UK&tn=rsqZwaWx-p1d-y1p&_nc_ht=scontent.fhan15-2.fna&oh=00_AT-BjSopFM0Hu_KXsMcgiAzyHYpw7-YM_8LbBE4qM0Bb_g&oe=6247EA6F 1068w, /assets/frontend/image/news_trangchu.png 300w, /assets/frontend/image/news_trangchu.png 768w, /assets/frontend/image/news_trangchu.png 1024w, /assets/frontend/image/news_trangchu.png 696w, /assets/frontend/image/news_trangchu.png747w,/assets/frontend/image/news_trangchu.png 1280w" sizes="(max-width: 1068px) 100vw, 1068px" alt="{{isset($data->title) ? $data->title : null}}" title="{{isset($data->title) ? $data->title : null}}"/>

                            @endif
                        </a>
                    </div>
                    <header class="td-post-title">
                        @if(isset($data->groups) && count($data->groups) > 0)
                        <ul class="td-category">
                            @foreach($data->groups as $group_item)
                                <li class="entry-category">
                                    <a  href="/blog{{isset($group_item->url) ? $group_item->url : $group_item->slug}}">{{$group_item->title}}</a>
                                </li>

                            @endforeach
                        </ul>
                        @endif
                        <h1 class="entry-title">{{isset($data->title) ? $data->title : null}}</h1>



                        <div class="td-module-meta-info">
                            <div class="td-post-author-name">
                                <div class="td-author-by">Bởi</div>
                                @if(isset($data->author->fullname))
                                    <a href="">{{isset($data->author->fullname) ? $data->author->fullname : $data->author->username}}</a>
                                @endif

                                <div class="td-author-line"> - </div> </div>
                            <span class="td-post-date">
                                <time class="entry-date updated td-module-date" >{{isset($data->created_at) ? $data->created_at : null}}</time>
                            </span>
                            <div class="td-post-views">
                                <i class="td-icon-views"></i>
                                <span class="td-nr-views-59015">{{isset($data->totalviews) ? $data->totalviews : null}}</span></div>
                            <div class="td-post-comments">
                                <a href="https://hoanghamobile.com/tin-tuc/danh-gia-realme-3-pro#respond">
                                    <i class="td-icon-comments"></i>0
                                </a>
                            </div>
                        </div>

                    </header>
                </div>
            </div>

            <div class="td-container">
                <div class="td-pb-row">
                    <div class="td-pb-span8 td-main-content" role="main">
                        <div class="td-ss-main-content">

{{--                            <div class="td-post-sharing-top">--}}
{{--                                <div id="td_social_sharing_article_top" class="td-post-sharing td-ps-bg td-ps-notext td-post-sharing-style1 ">--}}
{{--                                    <div class="td-post-sharing-visible">--}}
{{--                                        <a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-facebook" href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Ftintuc.hoanghamobile.com%2Ftin-tuc%2Fdanh-gia-realme-3-pro">--}}
{{--                                            <div class="td-social-but-icon"><i class="td-icon-facebook"></i></div>--}}
{{--                                            <div class="td-social-but-text">Facebook</div>--}}
{{--                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-twitter" href="https://twitter.com/intent/tweet?text=%C4%90%C3%A1nh+gi%C3%A1+Realme+3+Pro%3A+L%E1%BB%9Di+th%C3%A1ch+th%E1%BB%A9c+%C4%91%E1%BA%BFn+c%C3%A1c+%C4%91%E1%BB%91i+th%E1%BB%A7+c%C3%B9ng+ph%C3%A2n+kh%C3%BAc&url=https%3A%2F%2Ftintuc.hoanghamobile.com%2Ftin-tuc%2Fdanh-gia-realme-3-pro&via=Tin+t%E1%BB%A9c+c%C3%B4ng+ngh%E1%BB%87+-+HoangHaMobile">--}}
{{--                                            <div class="td-social-but-icon"><i class="td-icon-twitter"></i></div>--}}
{{--                                            <div class="td-social-but-text">Twitter</div>--}}
{{--                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-pinterest" href="https://pinterest.com/pin/create/button/?url=https://hoanghamobile.com/tin-tuc/danh-gia-realme-3-pro&amp;media=https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2019/05/danh-gia-realme-3-pro-021.jpg&description=Nếu đánh giá Realme 3 Pro trong phân khúc thị trường giá rẻ, đây sẽ là một lựa chọn tuyệt vời cho những bạn có niềm đam mê với game Fortnite.">--}}
{{--                                            <div class="td-social-but-icon"><i class="td-icon-pinterest"></i></div>--}}
{{--                                            <div class="td-social-but-text">Pinterest</div>--}}
{{--                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-whatsapp" href="whatsapp://send?text=%C4%90%C3%A1nh+gi%C3%A1+Realme+3+Pro%3A+L%E1%BB%9Di+th%C3%A1ch+th%E1%BB%A9c+%C4%91%E1%BA%BFn+c%C3%A1c+%C4%91%E1%BB%91i+th%E1%BB%A7+c%C3%B9ng+ph%C3%A2n+kh%C3%BAc %0A%0A https://hoanghamobile.com/tin-tuc/danh-gia-realme-3-pro">--}}
{{--                                            <div class="td-social-but-icon"><i class="td-icon-whatsapp"></i></div>--}}
{{--                                            <div class="td-social-but-text">WhatsApp</div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="td-social-sharing-hidden">--}}
{{--                                        <ul class="td-pulldown-filter-list"></ul>--}}
{{--                                        <a class="td-social-sharing-button td-social-handler td-social-expand-tabs" href="#" data-block-uid="td_social_sharing_article_top">--}}
{{--                                            <div class="td-social-but-icon"><i class="td-icon-plus td-social-expand-tabs-icon"></i></div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="td-post-content tagdiv-type">
                                {!! isset($data->content)?$data->content:'' !!}
                            </div>


                            <footer>
{{-- 
                                <div class="td-post-source-tags">
                                    <ul class="td-tags td-post-small-box clearfix"><li><span>TAGS</span></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/danh-gia-realme-3-pro">Đánh giá Realme 3 Pro</a></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/fortnite">Fortnite</a></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/gradient">Gradient</a></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/mua-realme-3-pro">Mua Realme 3 Pro</a></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/oppo">oppo</a></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/realme">Realme</a></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/realme-3">Realme 3</a></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/realme-3-pro">realme 3 pro</a></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/realme-3-pro-gia-re">Realme 3 Pro giá rẻ</a></li><li><a href="https://hoanghamobile.com/tin-tuc/tag/snapdragon-710">Snapdragon 710</a></li></ul>
                                </div> --}}

{{--                                <div class="td-post-sharing-bottom"><div class="td-post-sharing-classic"><iframe frameBorder="0" src="https://www.facebook.com/plugins/like.php?href=https://hoanghamobile.com/tin-tuc/danh-gia-realme-3-pro&amp;layout=button_count&amp;show_faces=false&amp;width=105&amp;action=like&amp;colorscheme=light&amp;height=21" style="border:none; overflow:hidden; width:auto; height:21px; background-color:transparent;"></iframe></div><div id="td_social_sharing_article_bottom" class="td-post-sharing td-ps-bg td-ps-notext td-post-sharing-style1 "><div class="td-post-sharing-visible"><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-facebook" href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Ftintuc.hoanghamobile.com%2Ftin-tuc%2Fdanh-gia-realme-3-pro">--}}
{{--                                                <div class="td-social-but-icon"><i class="td-icon-facebook"></i></div>--}}
{{--                                                <div class="td-social-but-text">Facebook</div>--}}
{{--                                            </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-twitter" href="https://twitter.com/intent/tweet?text=%C4%90%C3%A1nh+gi%C3%A1+Realme+3+Pro%3A+L%E1%BB%9Di+th%C3%A1ch+th%E1%BB%A9c+%C4%91%E1%BA%BFn+c%C3%A1c+%C4%91%E1%BB%91i+th%E1%BB%A7+c%C3%B9ng+ph%C3%A2n+kh%C3%BAc&url=https%3A%2F%2Ftintuc.hoanghamobile.com%2Ftin-tuc%2Fdanh-gia-realme-3-pro&via=Tin+t%E1%BB%A9c+c%C3%B4ng+ngh%E1%BB%87+-+HoangHaMobile">--}}
{{--                                                <div class="td-social-but-icon"><i class="td-icon-twitter"></i></div>--}}
{{--                                                <div class="td-social-but-text">Twitter</div>--}}
{{--                                            </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-pinterest" href="https://pinterest.com/pin/create/button/?url=https://hoanghamobile.com/tin-tuc/danh-gia-realme-3-pro&amp;media=https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2019/05/danh-gia-realme-3-pro-021.jpg&description=Nếu đánh giá Realme 3 Pro trong phân khúc thị trường giá rẻ, đây sẽ là một lựa chọn tuyệt vời cho những bạn có niềm đam mê với game Fortnite.">--}}
{{--                                                <div class="td-social-but-icon"><i class="td-icon-pinterest"></i></div>--}}
{{--                                                <div class="td-social-but-text">Pinterest</div>--}}
{{--                                            </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-whatsapp" href="whatsapp://send?text=%C4%90%C3%A1nh+gi%C3%A1+Realme+3+Pro%3A+L%E1%BB%9Di+th%C3%A1ch+th%E1%BB%A9c+%C4%91%E1%BA%BFn+c%C3%A1c+%C4%91%E1%BB%91i+th%E1%BB%A7+c%C3%B9ng+ph%C3%A2n+kh%C3%BAc %0A%0A https://hoanghamobile.com/tin-tuc/danh-gia-realme-3-pro">--}}
{{--                                                <div class="td-social-but-icon"><i class="td-icon-whatsapp"></i></div>--}}
{{--                                                <div class="td-social-but-text">WhatsApp</div>--}}
{{--                                            </a></div><div class="td-social-sharing-hidden"><ul class="td-pulldown-filter-list"></ul><a class="td-social-sharing-button td-social-handler td-social-expand-tabs" href="#" data-block-uid="td_social_sharing_article_bottom">--}}
{{--                                                <div class="td-social-but-icon"><i class="td-icon-plus td-social-expand-tabs-icon"></i></div>--}}
{{--                                            </a></div></div>--}}
{{--                                </div>    --}}
                                <div class="td-block-row td-post-next-prev"><div class="td-block-span6 td-post-prev-post"><div class="td-post-next-prev-content"><span>Bài trước</span><a href="https://hoanghamobile.com/tin-tuc/khuyen-mai-smartphone-samsung">Chào tháng 5: Mua Samsung, vi vu Hàn Quốc, trúng Galaxy A50 mỗi tuần</a></div></div><div class="td-next-prev-separator"></div><div class="td-block-span6 td-post-next-post"><div class="td-post-next-prev-content"><span>Bài tiếp theo</span><a href="https://hoanghamobile.com/tin-tuc/dien-thoai-honor-moi">Rò rỉ thiết kế Honor 20 Pro: Những tưởng như Huawei P30 Pro, đẹp xuất sắc</a></div></div></div>        <div class="td-author-name vcard author" style="display: none"><span class="fn"><a href="https://hoanghamobile.com/tin-tuc/author/sialthuong">sialthuong</a></span></div>        <span class="td-page-meta" itemprop="author" itemscope itemtype="https://schema.org/Person"><meta itemprop="name" content="sialthuong"></span><meta itemprop="datePublished" content="2019-05-02T01:56:15+07:00"><meta itemprop="dateModified" content="2019-09-15T08:34:43+07:00"><meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="https://hoanghamobile.com/tin-tuc/danh-gia-realme-3-pro"/><span class="td-page-meta" itemprop="publisher" itemscope itemtype="https://schema.org/Organization"><span class="td-page-meta" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject"><meta itemprop="url" content="/tin-tuc/wp-content/uploads/2017/08/Trang-tin-3.png"></span><meta itemprop="name" content="Tin tức công nghệ - HoangHaMobile"></span><meta itemprop="headline " content="Đánh giá Realme 3 Pro: Lời thách thức đến các đối thủ cùng phân khúc"><span class="td-page-meta" itemprop="image" itemscope itemtype="https://schema.org/ImageObject"><meta itemprop="url" content="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2019/05/danh-gia-realme-3-pro-021.jpg"><meta itemprop="width" content="1280"><meta itemprop="height" content="720"></span>    </footer>

                            <div class="td_block_wrap td_block_related_posts tdi_3_434 td_with_ajax_pagination td-pb-border-top td_block_template_1"  data-td-block-uid="tdi_3_434" ><script>var block_tdi_3_434 = new tdBlock();
                                    block_tdi_3_434.id = "tdi_3_434";
                                    block_tdi_3_434.atts = '{"limit":6,"ajax_pagination":"next_prev","live_filter":"cur_post_same_categories","td_ajax_filter_type":"td_custom_related","class":"tdi_3_434","td_column_number":3,"live_filter_cur_post_id":59015,"live_filter_cur_post_author":"1","block_template_id":"","header_color":"","ajax_pagination_infinite_stop":"","offset":"","td_ajax_preloading":"","td_filter_default_txt":"","td_ajax_filter_ids":"","el_class":"","color_preset":"","border_top":"","css":"","tdc_css":"","tdc_css_class":"tdi_3_434","tdc_css_class_style":"tdi_3_434_rand_style"}';
                                    block_tdi_3_434.td_column_number = "3";
                                    block_tdi_3_434.block_type = "td_block_related_posts";
                                    block_tdi_3_434.post_count = "6";
                                    block_tdi_3_434.found_posts = "12186";
                                    block_tdi_3_434.header_color = "";
                                    block_tdi_3_434.ajax_pagination_infinite_stop = "";
                                    block_tdi_3_434.max_num_pages = "2031";
                                    tdBlocksArray.push(block_tdi_3_434);
                                </script><h4 class="td-related-title td-block-title"><a id="tdi_4_cd4" class="td-related-left td-cur-simple-item" data-td_filter_value="" data-td_block_id="tdi_3_434" href="#">BÀI VIẾT LIÊN QUAN</a><a id="tdi_5_6ce" class="td-related-right" data-td_filter_value="td_related_more_from_author" data-td_block_id="tdi_3_434" href="#">XEM THÊM</a></h4><div id=tdi_3_434 class="td_block_inner">

                                    <div class="td-related-row">

                                        <div class="td-related-span4">

                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                                <div class="td-module-image">
                                                    <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/black-shark-5-series-lo-diem-hieu-nang-an-tuong-tren-geekbench" rel="bookmark" class="td-image-wrap" title="Black Shark 5 Series lộ điểm hiệu năng ấn tượng trên Geekbench"><img width="218" height="150" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/wp-1642408572953-1-218x150.jpg"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/wp-1642408572953-1-218x150.jpg 218w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/wp-1642408572953-1-100x70.jpg 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="wp-1642408572953-1" title="Black Shark 5 Series lộ điểm hiệu năng ấn tượng trên Geekbench" /></a></div>                            </div>
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/black-shark-5-series-lo-diem-hieu-nang-an-tuong-tren-geekbench" rel="bookmark" title="Black Shark 5 Series lộ điểm hiệu năng ấn tượng trên Geekbench">Black Shark 5 Series lộ điểm hiệu năng ấn tượng trên Geekbench</a></h3>            </div>
                                            </div>

                                        </div> <!-- ./td-related-span4 -->

                                        <div class="td-related-span4">

                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                                <div class="td-module-image">
                                                    <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/san-xuat-iphone-se-3" rel="bookmark" class="td-image-wrap" title="iPhone SE 3 5G là chiếc smartphone đầu tiên trên thế giới sản xuất từ nhôm không carbon"><img width="218" height="150" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/248340075_1434079883655719_461417009195591442_n-9-218x150.jpg"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/248340075_1434079883655719_461417009195591442_n-9-218x150.jpg 218w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/248340075_1434079883655719_461417009195591442_n-9-100x70.jpg 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="sản xuất iPhone SE 3" title="iPhone SE 3 5G là chiếc smartphone đầu tiên trên thế giới sản xuất từ nhôm không carbon" /></a></div>                            </div>
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/san-xuat-iphone-se-3" rel="bookmark" title="iPhone SE 3 5G là chiếc smartphone đầu tiên trên thế giới sản xuất từ nhôm không carbon">iPhone SE 3 5G là chiếc smartphone đầu tiên trên thế giới sản xuất từ nhôm không carbon</a></h3>            </div>
                                            </div>

                                        </div> <!-- ./td-related-span4 -->

                                        <div class="td-related-span4">

                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                                <div class="td-module-image">
                                                    <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/galaxy-s23-duoc-samsung-goi-la-du-an-kim-cuong-lieu-hang-dang-am-chi-dieu-gi" rel="bookmark" class="td-image-wrap" title="Galaxy S23 được Samsung gọi là &#8220;Dự án kim cương&#8221;, liệu hãng đang ám chỉ điều gì?"><img width="218" height="150" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/ten-ma-galaxy-s23-1-218x150.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/ten-ma-galaxy-s23-1-218x150.png 218w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/ten-ma-galaxy-s23-1-100x70.png 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="ten-ma-galaxy-s23-1" title="Galaxy S23 được Samsung gọi là &#8220;Dự án kim cương&#8221;, liệu hãng đang ám chỉ điều gì?" /></a></div>                            </div>
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/galaxy-s23-duoc-samsung-goi-la-du-an-kim-cuong-lieu-hang-dang-am-chi-dieu-gi" rel="bookmark" title="Galaxy S23 được Samsung gọi là &#8220;Dự án kim cương&#8221;, liệu hãng đang ám chỉ điều gì?">Galaxy S23 được Samsung gọi là &#8220;Dự án kim cương&#8221;, liệu hãng đang ám chỉ điều gì?</a></h3>            </div>
                                            </div>

                                        </div> <!-- ./td-related-span4 --></div><!--./row-fluid-->

                                    <div class="td-related-row">

                                        <div class="td-related-span4">

                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                                <div class="td-module-image">
                                                    <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/macbook-15-inch-duoc-don-dai-cua-apple-co-the-khong-phai-la-macbook-air" rel="bookmark" class="td-image-wrap" title="MacBook 15 inch được đồn đại của Apple có thể không phải là MacBook Air"><img width="218" height="150" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/MacBook-15-inch-1-218x150.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/MacBook-15-inch-1-218x150.png 218w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/MacBook-15-inch-1-100x70.png 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="MacBook-15-inch-1" title="MacBook 15 inch được đồn đại của Apple có thể không phải là MacBook Air" /></a></div>                            </div>
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/macbook-15-inch-duoc-don-dai-cua-apple-co-the-khong-phai-la-macbook-air" rel="bookmark" title="MacBook 15 inch được đồn đại của Apple có thể không phải là MacBook Air">MacBook 15 inch được đồn đại của Apple có thể không phải là MacBook Air</a></h3>            </div>
                                            </div>

                                        </div> <!-- ./td-related-span4 -->

                                        <div class="td-related-span4">

                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                                <div class="td-module-image">
                                                    <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo" rel="bookmark" class="td-image-wrap" title="Lộ diện những hình ảnh đầu tiên của máy tính bảng Vivo do chính thương hiệu công bố"><img width="218" height="150" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo-7-218x150.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo-7-218x150.png 218w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo-7-100x70.png 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo-7" title="Lộ diện những hình ảnh đầu tiên của máy tính bảng Vivo do chính thương hiệu công bố" /></a></div>                            </div>
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo" rel="bookmark" title="Lộ diện những hình ảnh đầu tiên của máy tính bảng Vivo do chính thương hiệu công bố">Lộ diện những hình ảnh đầu tiên của máy tính bảng Vivo do chính thương hiệu công bố</a></h3>            </div>
                                            </div>

                                        </div> <!-- ./td-related-span4 -->

                                        <div class="td-related-span4">

                                            <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                                <div class="td-module-image">
                                                    <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/chiem-nguong-chiec-iphone-13-pro-max-dac-biet-co-thoi-luong-pin-gap-doi-quat-tan-nhiet-va-ca-cong-usb-c" rel="bookmark" class="td-image-wrap" title="Chiêm ngưỡng chiếc iPhone 13 Pro Max đặc biệt: có thời lượng pin gấp đôi, quạt tản nhiệt và cả cổng USB-C"><img width="218" height="150" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/iPhone-13-Pro-Max-co-quat-tan-nhiet-5-218x150.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/iPhone-13-Pro-Max-co-quat-tan-nhiet-5-218x150.png 218w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/iPhone-13-Pro-Max-co-quat-tan-nhiet-5-100x70.png 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="iPhone-13-Pro-Max-co-quat-tan-nhiet-5" title="Chiêm ngưỡng chiếc iPhone 13 Pro Max đặc biệt: có thời lượng pin gấp đôi, quạt tản nhiệt và cả cổng USB-C" /></a></div>                            </div>
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/chiem-nguong-chiec-iphone-13-pro-max-dac-biet-co-thoi-luong-pin-gap-doi-quat-tan-nhiet-va-ca-cong-usb-c" rel="bookmark" title="Chiêm ngưỡng chiếc iPhone 13 Pro Max đặc biệt: có thời lượng pin gấp đôi, quạt tản nhiệt và cả cổng USB-C">Chiêm ngưỡng chiếc iPhone 13 Pro Max đặc biệt: có thời lượng pin gấp đôi, quạt tản nhiệt và cả cổng USB-C</a></h3>            </div>
                                            </div>

                                        </div> <!-- ./td-related-span4 --></div><!--./row-fluid--></div><div class="td-next-prev-wrap"><a href="#" class="td-ajax-prev-page ajax-page-disabled" id="prev-page-tdi_3_434" data-td_block_id="tdi_3_434"><i class="td-icon-font td-icon-menu-left"></i></a><a href="#"  class="td-ajax-next-page" id="next-page-tdi_3_434" data-td_block_id="tdi_3_434"><i class="td-icon-font td-icon-menu-right"></i></a></div></div> <!-- ./block -->
                        </div>
                    </div>
                    <div class="td-pb-span4 td-main-sidebar" role="complementary">
                        <div class="td-ss-main-sidebar">
                            <div class="td_block_wrap td_block_2 td_block_widget tdi_6_027 td-pb-border-top td_block_template_1 td-column-1 td_block_padding"  data-td-block-uid="tdi_6_027" ><script>var block_tdi_6_027 = new tdBlock();
                                    block_tdi_6_027.id = "tdi_6_027";
                                    block_tdi_6_027.atts = '{"custom_title":"B\u00c0I VI\u1ebeT M\u1edaI","custom_url":"","block_template_id":"","header_color":"#","header_text_color":"#","limit":"5","offset":"","post_ids":"","category_id":"","category_ids":"","tag_slug":"","autors_id":"","installed_post_types":"","sort":"","td_ajax_filter_type":"","td_ajax_filter_ids":"","td_filter_default_txt":"All","td_ajax_preloading":"","ajax_pagination":"","ajax_pagination_infinite_stop":"","class":"td_block_widget tdi_6_027","separator":"","m2_tl":"","m2_el":"","m6_tl":"","show_modified_date":"","el_class":"","f_header_font_header":"","f_header_font_title":"Block header","f_header_font_settings":"","f_header_font_family":"","f_header_font_size":"","f_header_font_line_height":"","f_header_font_style":"","f_header_font_weight":"","f_header_font_transform":"","f_header_font_spacing":"","f_header_":"","f_ajax_font_title":"Ajax categories","f_ajax_font_settings":"","f_ajax_font_family":"","f_ajax_font_size":"","f_ajax_font_line_height":"","f_ajax_font_style":"","f_ajax_font_weight":"","f_ajax_font_transform":"","f_ajax_font_spacing":"","f_ajax_":"","f_more_font_title":"Load more button","f_more_font_settings":"","f_more_font_family":"","f_more_font_size":"","f_more_font_line_height":"","f_more_font_style":"","f_more_font_weight":"","f_more_font_transform":"","f_more_font_spacing":"","f_more_":"","m2f_title_font_header":"","m2f_title_font_title":"Article title","m2f_title_font_settings":"","m2f_title_font_family":"","m2f_title_font_size":"","m2f_title_font_line_height":"","m2f_title_font_style":"","m2f_title_font_weight":"","m2f_title_font_transform":"","m2f_title_font_spacing":"","m2f_title_":"","m2f_cat_font_title":"Article category tag","m2f_cat_font_settings":"","m2f_cat_font_family":"","m2f_cat_font_size":"","m2f_cat_font_line_height":"","m2f_cat_font_style":"","m2f_cat_font_weight":"","m2f_cat_font_transform":"","m2f_cat_font_spacing":"","m2f_cat_":"","m2f_meta_font_title":"Article meta info","m2f_meta_font_settings":"","m2f_meta_font_family":"","m2f_meta_font_size":"","m2f_meta_font_line_height":"","m2f_meta_font_style":"","m2f_meta_font_weight":"","m2f_meta_font_transform":"","m2f_meta_font_spacing":"","m2f_meta_":"","m2f_ex_font_title":"Article excerpt","m2f_ex_font_settings":"","m2f_ex_font_family":"","m2f_ex_font_size":"","m2f_ex_font_line_height":"","m2f_ex_font_style":"","m2f_ex_font_weight":"","m2f_ex_font_transform":"","m2f_ex_font_spacing":"","m2f_ex_":"","m6f_title_font_header":"","m6f_title_font_title":"Article title","m6f_title_font_settings":"","m6f_title_font_family":"","m6f_title_font_size":"","m6f_title_font_line_height":"","m6f_title_font_style":"","m6f_title_font_weight":"","m6f_title_font_transform":"","m6f_title_font_spacing":"","m6f_title_":"","m6f_cat_font_title":"Article category tag","m6f_cat_font_settings":"","m6f_cat_font_family":"","m6f_cat_font_size":"","m6f_cat_font_line_height":"","m6f_cat_font_style":"","m6f_cat_font_weight":"","m6f_cat_font_transform":"","m6f_cat_font_spacing":"","m6f_cat_":"","m6f_meta_font_title":"Article meta info","m6f_meta_font_settings":"","m6f_meta_font_family":"","m6f_meta_font_size":"","m6f_meta_font_line_height":"","m6f_meta_font_style":"","m6f_meta_font_weight":"","m6f_meta_font_transform":"","m6f_meta_font_spacing":"","m6f_meta_":"","css":"","tdc_css":"","td_column_number":1,"color_preset":"","border_top":"","tdc_css_class":"tdi_6_027","tdc_css_class_style":"tdi_6_027_rand_style"}';
                                    block_tdi_6_027.td_column_number = "1";
                                    block_tdi_6_027.block_type = "td_block_2";
                                    block_tdi_6_027.post_count = "5";
                                    block_tdi_6_027.found_posts = "15841";
                                    block_tdi_6_027.header_color = "#";
                                    block_tdi_6_027.ajax_pagination_infinite_stop = "";
                                    block_tdi_6_027.max_num_pages = "3169";
                                    tdBlocksArray.push(block_tdi_6_027);
                                </script>
                                <div class="td-block-title-wrap">
                                    <h4 class="block-title td-block-title">
                                        <span class="td-pulldown-size">BÀI VIẾT MỚI</span>
                                    </h4>
                                </div>
                                <div id=tdi_6_027 class="td_block_inner">
                                    <div class="td-block-span12">
                                        <div class="td_module_2 td_module_wrap td-animation-stack">
                                            <div class="td-module-image">
                                                <div class="td-module-thumb">
                                                    <a href="https://hoanghamobile.com/tin-tuc/black-shark-5-series-lo-diem-hieu-nang-an-tuong-tren-geekbench" rel="bookmark" class="td-image-wrap" title="Black Shark 5 Series lộ điểm hiệu năng ấn tượng trên Geekbench">
                                                        <img width="324" height="160" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/wp-1642408572953-1-324x160.jpg"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/wp-1642408572953-1-324x160.jpg 324w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/wp-1642408572953-1-533x261.jpg 533w" sizes="(max-width: 324px) 100vw, 324px"  alt="wp-1642408572953-1" title="Black Shark 5 Series lộ điểm hiệu năng ấn tượng trên Geekbench" />
                                                    </a>
                                                </div>
                                                <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>
                                            </div>
                                            <h3 class="entry-title td-module-title">
                                                <a href="https://hoanghamobile.com/tin-tuc/black-shark-5-series-lo-diem-hieu-nang-an-tuong-tren-geekbench" rel="bookmark" title="Black Shark 5 Series lộ điểm hiệu năng ấn tượng trên Geekbench">Black Shark 5 Series lộ điểm hiệu năng ấn tượng trên...</a>
                                            </h3>
                                            <div class="td-module-meta-info">
                                                <span class="td-post-date">
                                                    <time class="entry-date updated td-module-date" datetime="2022-03-27T21:14:04+00:00" >27 Tháng Ba, 2022</time>
                                                </span>
                                            </div>
                                            <div class="td-excerpt">
                                                Theo phát hiện từ trang Gizmochina, bộ đôi điện thoại Black Shark 5 và Black Shark 5 Pro đã xuất hiện trên Geekbench, hé...
                                            </div>
                                        </div>


                                    </div> <!-- ./td-block-span12 -->

                                    <div class="td-block-span12">
                                        <div class="td_module_6 td_module_wrap td-animation-stack">
                                            <div class="td-module-thumb">
                                                <a href="https://hoanghamobile.com/tin-tuc/san-xuat-iphone-se-3" rel="bookmark" class="td-image-wrap" title="iPhone SE 3 5G là chiếc smartphone đầu tiên trên thế giới sản xuất từ nhôm không carbon"><img width="100" height="70" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/248340075_1434079883655719_461417009195591442_n-9-100x70.jpg"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/248340075_1434079883655719_461417009195591442_n-9-100x70.jpg 100w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/248340075_1434079883655719_461417009195591442_n-9-218x150.jpg 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="sản xuất iPhone SE 3" title="iPhone SE 3 5G là chiếc smartphone đầu tiên trên thế giới sản xuất từ nhôm không carbon" /></a>
                                            </div>
                                            <div class="item-details">
                                                <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/san-xuat-iphone-se-3" rel="bookmark" title="iPhone SE 3 5G là chiếc smartphone đầu tiên trên thế giới sản xuất từ nhôm không carbon">iPhone SE 3 5G là chiếc smartphone đầu tiên trên thế...</a></h3>            <div class="td-module-meta-info">
                                                    <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-27T20:58:36+00:00" >27 Tháng Ba, 2022</time></span>                            </div>
                                            </div>
                                        </div>

                                    </div> <!-- ./td-block-span12 -->

                                    <div class="td-block-span12">
                                        <div class="td_module_6 td_module_wrap td-animation-stack">

                                            <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/galaxy-s23-duoc-samsung-goi-la-du-an-kim-cuong-lieu-hang-dang-am-chi-dieu-gi" rel="bookmark" class="td-image-wrap" title="Galaxy S23 được Samsung gọi là &#8220;Dự án kim cương&#8221;, liệu hãng đang ám chỉ điều gì?"><img width="100" height="70" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/ten-ma-galaxy-s23-1-100x70.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/ten-ma-galaxy-s23-1-100x70.png 100w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/ten-ma-galaxy-s23-1-218x150.png 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="ten-ma-galaxy-s23-1" title="Galaxy S23 được Samsung gọi là &#8220;Dự án kim cương&#8221;, liệu hãng đang ám chỉ điều gì?" /></a></div>
                                            <div class="item-details">
                                                <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/galaxy-s23-duoc-samsung-goi-la-du-an-kim-cuong-lieu-hang-dang-am-chi-dieu-gi" rel="bookmark" title="Galaxy S23 được Samsung gọi là &#8220;Dự án kim cương&#8221;, liệu hãng đang ám chỉ điều gì?">Galaxy S23 được Samsung gọi là &#8220;Dự án kim cương&#8221;, liệu...</a></h3>            <div class="td-module-meta-info">
                                                    <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-27T17:18:36+00:00" >27 Tháng Ba, 2022</time></span>                            </div>
                                            </div>
                                        </div>

                                    </div> <!-- ./td-block-span12 -->

                                    <div class="td-block-span12">

                                        <div class="td_module_6 td_module_wrap td-animation-stack">

                                            <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/macbook-15-inch-duoc-don-dai-cua-apple-co-the-khong-phai-la-macbook-air" rel="bookmark" class="td-image-wrap" title="MacBook 15 inch được đồn đại của Apple có thể không phải là MacBook Air"><img width="100" height="70" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/MacBook-15-inch-1-100x70.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/MacBook-15-inch-1-100x70.png 100w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/MacBook-15-inch-1-218x150.png 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="MacBook-15-inch-1" title="MacBook 15 inch được đồn đại của Apple có thể không phải là MacBook Air" /></a></div>
                                            <div class="item-details">
                                                <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/macbook-15-inch-duoc-don-dai-cua-apple-co-the-khong-phai-la-macbook-air" rel="bookmark" title="MacBook 15 inch được đồn đại của Apple có thể không phải là MacBook Air">MacBook 15 inch được đồn đại của Apple có thể không...</a></h3>            <div class="td-module-meta-info">
                                                    <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-27T12:21:10+00:00" >27 Tháng Ba, 2022</time></span>                            </div>
                                            </div>

                                        </div>


                                    </div> <!-- ./td-block-span12 -->

                                    <div class="td-block-span12">

                                        <div class="td_module_6 td_module_wrap td-animation-stack">

                                            <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo" rel="bookmark" class="td-image-wrap" title="Lộ diện những hình ảnh đầu tiên của máy tính bảng Vivo do chính thương hiệu công bố"><img width="100" height="70" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo-7-100x70.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo-7-100x70.png 100w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo-7-218x150.png 218w" sizes="(max-width: 100px) 100vw, 100px"  alt="lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo-7" title="Lộ diện những hình ảnh đầu tiên của máy tính bảng Vivo do chính thương hiệu công bố" /></a></div>
                                            <div class="item-details">
                                                <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/lo-dien-nhung-hinh-anh-dau-tien-cua-may-tinh-bang-vivo-do-chinh-thuong-hieu-cong-bo" rel="bookmark" title="Lộ diện những hình ảnh đầu tiên của máy tính bảng Vivo do chính thương hiệu công bố">Lộ diện những hình ảnh đầu tiên của máy tính bảng...</a></h3>            <div class="td-module-meta-info">
                                                    <a href="https://hoanghamobile.com/tin-tuc/category/tin-tuc/tin-hot" class="td-post-category">Tin hot</a>                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2022-03-27T12:21:00+00:00" >27 Tháng Ba, 2022</time></span>                            </div>
                                            </div>

                                        </div>


                                    </div> <!-- ./td-block-span12 --></div></div> <!-- ./block -->                        </div>
                    </div>
                </div> <!-- /.td-pb-row -->
            </div> <!-- /.td-container -->
        </article> <!-- /.post -->

        <!-- Instagram -->




    <!-- Page generated by LiteSpeed Cache 4.4.7 on 2022-03-27 23:44:46 -->
@endsection

