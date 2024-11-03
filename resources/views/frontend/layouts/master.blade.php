<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="path" content="" />
    <meta name="jwt" content="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/frontend/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/frontend/lib/swiper/swiper.min.css">
    <link rel="stylesheet" href="/assets/frontend/lib/date-picker/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="/assets/frontend/lib/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="/assets/frontend/lib/fancybox/fancybox.css">
    <link rel="stylesheet" href="/assets/frontend/css/main.css">
    <link rel="stylesheet" href="/assets/frontend/css/style-custom.css">
    <link rel="stylesheet" href="/assets/frontend/css/slide.css">
    <link rel="stylesheet" href="/assets/frontend/css/style.css">
    <link rel="stylesheet" href="/assets/frontend/css/document.css">
    <script src="/assets/frontend/lib/jquery/jquery.min.js"></script>
</head>

<body>
<div class="layout">
    <div class="content container px-0" >
        @include('frontend.layouts.includes.header')
        <!-- content-->
        @yield('content')

        @include('frontend.layouts.includes.footer')

    </div>
</div>

<script src="/assets/frontend/lib/bootstrap/bootstrap.min.js"></script>
<script src="/assets/frontend/lib/fancybox/fancybox.umd.js"></script>
<script src="/assets/frontend/lib/slick/slick.min.js"></script>
<script src="/assets/frontend/lib/swiper/swiper.min.js"></script>
<script src="/assets/frontend/lib/date-picker/bootstrap-datetimepicker.js"></script>
<script src="/assets/frontend/js/swiper-slider-conf.js"></script>
<script src="/assets/frontend/js/main.js"></script>

</body>


</html>
