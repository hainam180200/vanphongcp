<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('seo_head')
    @if (\App\Library\HelpersDevice::isMobile())
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
        <link rel="stylesheet" href="/assets/frontend/css/mobile/style.css">
        <link rel="stylesheet" href="/assets/frontend/css/mobile/account.css">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css'>
    @else
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
        <link rel="stylesheet" href="/assets/frontend/css/desktop/style.css">
        <link rel="stylesheet" href="/assets/frontend/css/desktop/style-detail.css">
        <link rel="stylesheet" href="/assets/frontend/css/desktop/account.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css'>
        <link rel="preload" as="script"  href="/assets/frontend/js/desktop/action.js">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    @endif
    <link href="/assets/frontend/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    <!-- BK CSS -->
    <link rel="stylesheet" href="https://pc.baokim.vn/css/bk.css">
    <!-- END BK CSS -->
    @if (setting('sys_schema') != "")
        {!! setting('sys_schema') !!}
    @endif
    @if(Request::is('/'))
    @if (setting('sys_background') != '')
        <style>
            body{
               background: #f4f4f4 url('{{\App\Library\Files::media(setting('sys_background'))}}');
               background-attachment: fixed;
               background-size: 100%;
            }
        </style>
    @endif
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
@if (\App\Library\HelpersDevice::isMobile())
    <div class="mobile-wrapper">
            @include('frontend.layouts.includes.mobile.header_navbar')
    <div class="body-content">
@endif

@if (\App\Library\HelpersDevice::isMobile())
    @include('frontend.layouts.includes.mobile.header')
@else
    @include('frontend.layouts.includes.desktop.header')
@endif


@yield('content')


@if (\App\Library\HelpersDevice::isMobile())
    @include('frontend.layouts.includes.mobile.footer')
@else
    @include('frontend.layouts.includes.desktop.footer')
@endif
@if (\App\Library\HelpersDevice::isMobile())
        </div>
    </div>
@endif

@if (setting('sys_popup_image') != '' && setting('sys_active_popup') == '1')
<div id="popup-modal">
    <div class="modal detail_config_1 " id="quangcao">
        <div class="modal-overlay detail_config_button_1"></div>
        <div class="modal-wrapper modal-transition">
            <button class="modal-close detail_config_button_1" style="background: red; padding: 8px 10px;font-size: 12px;border-radius: 100%;"><i class="fas fa-times"></i></button>
            <img src="{{\App\Library\Files::media(setting('sys_popup_image'))}}" style="width: 100%" alt="">
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        if (sessionStorage.getItem("story") !== 'true') {
            sessionStorage.setItem("story", "true");
            $('#quangcao').toggleClass('is-visible');
        }
    });
</script>
@endif

<div id="backtoTop">
    <a id="top" href="javascript:;">
        <i class="fas fa-chevron-left"></i>
    </a>
</div>
<div id="navSocial">
    <div class="social">
        <ul>
            @if (setting('sys_zalo') != "")
                <li><a href="{{setting('sys_zalo')}}" title="Zalo" target="_blank" class="blue"><span><img src="/assets/frontend/image/zalo.png " alt="" ></span></a></li>
            @endif
            @if (setting('sys_youtube') != "")
                <li><a href="{{setting('sys_youtube')}}" title="Youtube" target="_blank" class="red"><span><img src="/assets/frontend/image/youtube.svg" alt="" ></span></a></li>
            @endif
            @if (setting('sys_fanpage') != "")
                <li><a href="{{setting('sys_fanpage')}}" title="Facebook" target="_blank" class="blue"><span><img src="/assets/frontend/image/facebook.svg " alt="" ></span></a></li>
            @endif
            @if (setting('sys_instagram') != "")
                <li><a href="{{setting('sys_instagram')}}" title="Instagram" target="_blank" class="rainbow"><span><img src="/assets/frontend/image/instagram.svg " alt="" ></span></a></li>
            @endif
            @if (setting('sys_tiktok') != "")
                <li><a href="{{setting('sys_tiktok')}}" title="Tiktok" target="_blank" class="black"><span><img src="/assets/frontend/image/tiktok.svg " alt="" ></span></a></li>
            @endif
        </ul>
    </div>
</div>
<div id="sticker-modal"></div>
<div class="search-bg"></div>

<script type='text/javascript' src='/assets/frontend/lib/tagdiv_theme.min.js'></script>

@if (\App\Library\HelpersDevice::isMobile())

    {{-- mobile thì kéo vào đây --}}
    <script src="/assets/frontend/js/mobile/action.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js'></script>
    <script type="text/javascript">
        $(document).ready(function () {
            sliderContent_init();
            sliderTestimonial_init();
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#dien-thoai-di-dong, #dien-thoai-di-dongiphone').addClass('actived');

            imagePreview_init();
            setProductContentHeighWithSpecs();

            compareAutocomplete(
                {
                    template : '/so-sanh/apple-iphone-13-mini-512gb-chinh-hang-vn-a-ss.1323',
                    ptype : 1,
                    ignore : 1323

                });
            updateViewProduct(1323);
            productDetails();
        });


        $(document).ready(function () {
            $("button.next").click(function () {
                $(".cart-info").hide();
                $(".cart-form").show();
            });

            $(".showInfo").click(function () {
                $(".cart-info").show();
                $(".cart-form").hide();
            });

            init_cityChange(0);

        });


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

    </script>
@else
    <div id="popup-modal"></div>
    <div id="sticker-modal"></div>
    <div class="search-bg"></div>
    <!-- accesstrade-->


    <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js'></script>
    <script src="/assets/frontend/js/desktop/action.js"></script>
    <script type="text/javascript">
        hh_home();
    </script>
    <script type="text/javascript">
        var isInCheckDelivery = 1;

        $(document).ready(function () {

            $('#dien-thoai-di-dong, #dien-thoai-di-dongiphone').addClass('actived');

            imagePreview_init();
            setProductContentHeighWithSpecs();

            compareAutocomplete(
                {
                    template : '/so-sanh/apple-iphone-13-mini-512gb-chinh-hang-vn-a-ss.1323',
                    ptype : 1,
                    ignore : 1323

                });
            updateViewProduct(1323);
            productDetails();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {


            $('#dien-thoai-di-dongiphone, #dien-thoai-di-dong').addClass('actived');

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
        });
    </script>
@endif
<script src="/assets/frontend/plugins/toastr/toastr.min.js"></script>
<script src="/assets/frontend/js/cart.js"></script>
<script src="/assets/frontend/js/search.js"></script>
<!-- BK JS -->
<script src="https://pc.baokim.vn/js/bk_plus_v2.popup.js"></script>
<!-- END BK JS -->
{!! setting('sys_message') !!}
</body>
</html>
