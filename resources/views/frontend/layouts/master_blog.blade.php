<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('seo_head')
    <link rel="stylesheet" href="/assets/frontend/css/news.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <script type='text/javascript' src='/assets/frontend/lib/jquery.min.js'></script>
    <script type='text/javascript' src='/assets/frontend/lib/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='/assets/frontend/lib/tagdiv_theme.min.js'></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
{{--    <link rel="stylesheet" href="/assets/frontend/css/desktop/style.css">--}}
{{--    <link rel="stylesheet" href="/assets/frontend/css/desktop/style-detail.css">--}}
{{--    <link rel="stylesheet" href="/assets/frontend/css/desktop/account.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
{{--    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css'>--}}
{{--    <link rel="preload" as="script"  href="/assets/frontend/js/desktop/action.js">--}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js'></script>
    @if (setting('sys_schema') != "")
        {!! setting('sys_schema') !!}
    @endif

    @if (setting('sys_color') != '')
        <style>
            :root {
                --main-color: {{setting('sys_color')}} ;
                --mix-color:  {{setting('sys_color')}};

            }
        </style>
    @else
        <style>
            :root {
                --main-color: #660099 ;
                --mix-color:  #660099;

            }
        </style>
    @endif
</head>
<body>
    <div id="td-outer-wrap" class="td-theme-wrap">
        @include('frontend.layouts.includes.header_news')
            @yield('content')
        @include('frontend.layouts.includes.footer_news')
    </div>
    {!! setting('sys_message') !!}
</body>



<script>

    $(document).ready(function(){

        $('.lrs-slider').owlCarousel({
            itemClass: 'lr-item',
            navText: [
                "<i class=\"fas fa-chevron-left\"></i>",
                "<i class=\"fas fa-chevron-right\"></i>"
            ],
            loop: false,
            items:8,
            autoplay: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            margin: 10,

        });
        // const hostname = window.location.pathname;
        // const media = "https://demo.muasammoingay.net/";

        function IsJsonString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }

        var page = 1;
        $("body").on('click', '.nav-search-in-value-load-more', function(e) {
            e.preventDefault();
            var news = $('#searchNews').val();
            page++;
            search(news,page);
        });

        ;(function($){
            $.fn.extend({
                donetyping: function(callback,timeout){

                    timeout = timeout || 1e3; // 1 second default timeout
                    var timeoutReference,
                        doneTyping = function(el){
                            if (!timeoutReference) return;
                            timeoutReference = null;
                            callback.call(el);
                        };
                    return this.each(function(i,el){
                        var $el = $(el);
                        $el.is(':input') && $el.on('keyup keypress paste',function(e){
                            if (e.type=='keyup' && !([8,46].includes(e.keyCode))){return;}
                            if (timeoutReference) clearTimeout(timeoutReference);
                            timeoutReference = setTimeout(function(){
                                doneTyping(el);
                            }, timeout);
                        }).on('blur',function(){
                            doneTyping(el);
                        });
                    });
                }
            });
        })(jQuery);

        $('.searchNews').donetyping(function() {
            console.log(1111)
            var news = $(this).val();
            if(news == null || news === "" || news === undefined){
                $('.news_results').css('display','none');
                return false;
            }
            search(news);
        }, 300);
        function search(news, append = false) {
            $.ajax({
                type: 'GET',
                url: '/tim-kiem-bai-viet',
                data: {
                    news:news
                },
                beforeSend: function (xhr) {
                    console.log(22222)
                },
                success: (data) => {
                    let html = "";
                    let html1 = "";
                    console.log(data)
                    if(data.status == 1){
                        if(data.data.length === 0){

                            html += '<div style="color:#f63;padding: 20px;text-align: center;font-weight: 700;justify-content: center" class="search-item" id="nav-search_none">';
                            html += 'Không tìm thấy bài viết';
                            html += '</div>';

                            $('.news_results').html(html);
                            $('.news_results').css('display','block');
                            // $('.nav-search-in-value-load-more').css('display','none');

                        }
                        else{
                            $.each(data.data,function(key,value){
                                console.log(value.title)
                                html += ' <div class="td_module_mx2 td_module_wrap td-animation-stack">';
                                html += '<div class="td-module-thumb">';
                                if(value.url != null ){
                                    html += '<a href="'+value.url+'" class="td-image-wrap" title="">' ;
                                }else{
                                    html += '<a href="'+value.slug+'" class="td-image-wrap" title="">' ;
                                }
                                html += '<a href="" class="td-image-wrap" title="">';
                                html += '<img width="80" height="60" class="entry-thumb" src="\thttps://demo.muasammoingay.net/storage'+value.image+'"  sizes="(max-width: 80px) 100vw, 80px" alt="" title="'+value.title+'">';
                                 html += '</a>';
                                 html += ' </div>';
                                 html += ' <div class="item-details">';
                                 html += ' <h3 class="entry-title td-module-title">';
                                if(value.url != null ){
                                    html += '<a href="'+value.url+'" title="">'+value.title+'</a>';
                                }else{
                                    html += '<a href="'+value.slug+'" title="">'+value.title+'</a>';
                                }
                                 html += '</h3>';
                                 html += ' <div class="td-module-meta-info">';
                                 html += '  <a href="" class="td-post-category">Đánh giá</a>';
                                 html += '  <span class="td-post-date">';
                                 html += '<time class="entry-date updated td-module-date" date-time="2022-03-30T10:59:47+00:00">'+value.updated_at+'</time>';
                                 html += '</span>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';

                                // if(value.url != null ){
                                //     html += value.url;
                                // }else{
                                //     html += value.slug;
                                // }
                                // html += '">';
                                // html += value.title;
                                // html += '</a></h2>';
                                // html += '<h3>' +value.price+'</h3>';
                                //
                                // html += '</div>';
                                // html += '</div>';
                            });
                            $('.news_results').css('display','block');

                            $('.news_results').append(html);

                            // if(data.data.current_page == 1){
                            //
                            //     $('#result-search').html(html);
                            //     if(data.appen === 0){
                            //         $('.nav-search-in-value-load-more').css('display','none');
                            //     }
                            //     else{
                            //         $('.nav-search-in-value-load-more').css('display','block');
                            //     }
                            // }
                            // else{
                            //     console.log(333)
                            //     $('#result-search').append(html);
                            // }
                            // $('.hihi').css('display','block');
                        }
                    }
                    else{
                        console.log(111)
                        $('.news_results').css('display','none');
                    }
                },
                error: function (data) {

                },
                complete: function (data) {

                }
            });
        }



        // Tim kiem mobile
        var page1 = 1;
        $("body").on('click', '.nav-search-in-value-load-more', function(e) {
            e.preventDefault();
            var news = $('#searchNewsMobile').val();
            page1++;
            search(news,page1);
        });

        ;(function($){
            $.fn.extend({
                donetyping: function(callback,timeout){

                    timeout = timeout || 1e3; // 1 second default timeout
                    var timeoutReference,
                        doneTyping = function(el){
                            if (!timeoutReference) return;
                            timeoutReference = null;
                            callback.call(el);
                        };
                    return this.each(function(i,el){
                        var $el = $(el);
                        $el.is(':input') && $el.on('keyup keypress paste',function(e){
                            if (e.type=='keyup' && !([8,46].includes(e.keyCode))){return;}
                            if (timeoutReference) clearTimeout(timeoutReference);
                            timeoutReference = setTimeout(function(){
                                doneTyping(el);
                            }, timeout);
                        }).on('blur',function(){
                            doneTyping(el);
                        });
                    });
                }
            });
        })(jQuery);

        $('.searchNewsMobile').donetyping(function() {
            console.log(222);
            var news = $(this).val();
            if(news == null || news === "" || news === undefined){
                $('.news_results_mobile').css('display','none');
                return false;
            }
            searchMobile(news);
        }, 300);
        function searchMobile(news, append = false) {
            $.ajax({
                type: 'GET',
                url: '/tim-kiem-bai-viet',
                data: {
                    news:news
                },
                beforeSend: function (xhr) {
                    console.log(22222)
                },
                success: (data) => {
                    let html = "";
                    let html1 = "";
                    console.log(data)
                    if(data.status == 1){
                        if(data.data.length === 0){

                            html += '<div style="color:#f63;padding: 20px;text-align: center;font-weight: 700;justify-content: center" class="search-item" id="nav-search_none">';
                            html += 'Không tìm thấy bài viết';
                            html += '</div>';

                            $('.news_results_mobile').html(html);
                            $('.news_results_mobile').css('display','block');
                            // $('.nav-search-in-value-load-more').css('display','none');

                        }
                        else{
                            $.each(data.data,function(key,value){
                                console.log(value.title)
                                html += '   <div class="td_module_mx2 td_module_wrap td-animation-stack">';
                                html += ' <div class="td-module-thumb">';
                                if(value.url != null ){
                                    html += '<a href="'+value.url+'" class="td-image-wrap" title="">' ;
                                }else{
                                    html += '<a href="'+value.slug+'" class="td-image-wrap" title="">' ;
                                }
                                html += '<a href="" class="td-image-wrap" title="">';
                                html += '<img width="80" height="60" class="entry-thumb" src="\thttps://demo.muasammoingay.net/storage'+value.image+'"  sizes="(max-width: 80px) 100vw, 80px" alt="" title="'+value.title+'">';
                                html += '</a>';
                                html += ' </div>';
                                html += ' <div class="item-details">';
                                html += ' <h3 class="entry-title td-module-title">';
                                if(value.url != null ){
                                    html += '<a href="'+value.url+'" title="">'+value.title+'</a>';
                                }else{
                                    html += '<a href="'+value.slug+'" title="">'+value.title+'</a>';
                                }
                                html += '</h3>';
                                html += ' <div class="td-module-meta-info">';
                                html += '  <a href="" class="td-post-category">Đánh giá</a>';
                                html += '  <span class="td-post-date">';
                                html += '<time class="entry-date updated td-module-date" date-time="2022-03-30T10:59:47+00:00">'+value.updated_at+'</time>';
                                html += '</span>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';

                                // if(value.url != null ){
                                //     html += value.url;
                                // }else{
                                //     html += value.slug;
                                // }
                                // html += '">';
                                // html += value.title;
                                // html += '</a></h2>';
                                // html += '<h3>' +value.price+'</h3>';
                                //
                                // html += '</div>';
                                // html += '</div>';
                            });
                            $('.news_results_mobile').css('display','block');

                            $('.news_results_mobile').append(html);

                            // if(data.data.current_page == 1){
                            //
                            //     $('#result-search').html(html);
                            //     if(data.appen === 0){
                            //         $('.nav-search-in-value-load-more').css('display','none');
                            //     }
                            //     else{
                            //         $('.nav-search-in-value-load-more').css('display','block');
                            //     }
                            // }
                            // else{
                            //     console.log(333)
                            //     $('#result-search').append(html);
                            // }
                            // $('.hihi').css('display','block');
                        }
                    }
                    else{
                        $('.news_results_mobile').css('display','none');
                    }
                },
                error: function (data) {

                },
                complete: function (data) {

                }
            });
        }
    })
</script>
<script>
    jQuery(document).ready(function() {
        jQuery("#tdi_7_2c1").iosSlider({
            snapToChildren: true,
            desktopClickDrag: true,
            keyboardControls: false,
            responsiveSlideContainer: true,
            responsiveSlides: true,
            autoSlide: true,
            autoSlideTimer: 1500,
            infiniteSlider: true,
            navPrevSelector: jQuery("#tdi_7_2c1 .prevButton"),
            navNextSelector: jQuery("#tdi_7_2c1 .nextButton")
            ,
            //onSliderLoaded : td_resize_normal_slide,
            //onSliderResize : td_resize_normal_slide_and_update
        });
    });
</script>
</html>
