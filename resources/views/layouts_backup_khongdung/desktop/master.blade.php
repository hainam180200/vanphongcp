<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('seo_head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="/assets/frontend/css/desktop/style.css">
    <link rel="stylesheet" href="/assets/frontend/css/desktop/style-detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css'>
    <link rel="preload" as="script"  href="/assets/frontend/js/desktop/action.js">
</head>
<body>
@include('layouts.desktop.header')
    @yield('content')
@include('layouts.desktop.footer')

<div id="popup-modal"></div>
<div id="sticker-modal"></div>
<div class="search-bg"></div>
<script src="//static.accesstrade.vn/js/trackingtag/tracking.min.js "></script>
<!-- accesstrade-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
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

    function getPage(p) {
        var urlReq = '/dien-thoai-di-dong/iphone?p=' + p;
        $.get(urlReq, function (data) {
            $("#page-holder").append(data).hide().fadeIn(500);
        });

    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        showSticker(38);
    });
</script>
</body>
</html>
