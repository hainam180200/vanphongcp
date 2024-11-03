$(document).ready(function(){
    var banner_slide = new Swiper('.swiper-banner', {
        autoplay: true,
        pagination: {
            el: '.swiper-banner .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-banner .swiper-button-next',
            prevEl: '.swiper-banner .swiper-button-prev',
        },
        updateOnImagesReady: true,
        watchSlidesVisibility: false,
        lazyLoadingInPrevNext: false,
        lazyLoadingOnTransitionStart: false,
        centeredSlides: false,
        slidesPerView: 1,
        speed: 600,
        delay: 3000,
        loop: "infinite",
        freeMode: false,
        touchMove: true,
        freeModeSticky:true,
        grabCursor: true,
        observer: true,
        observeParents: true,
        keyboard: {
            enabled: true,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
    var ads_slide = new Swiper('.swiper-ads', {
        autoplay: true,
        pagination: {
            el: '.swiper-slide-v2 .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-ads .swiper-button-next',
            prevEl: '.swiper-ads .swiper-button-prev',
        },
        updateOnImagesReady: true,
        watchSlidesVisibility: false,
        lazyLoadingInPrevNext: false,
        lazyLoadingOnTransitionStart: false,
        centeredSlides: false,
        slidesPerView: 1,
        speed: 600,
        delay: 3000,
        loop: "infinite",
        freeMode: false,
        touchMove: true,
        freeModeSticky:true,
        grabCursor: true,
        observer: true,
        observeParents: true,
        keyboard: {
            enabled: true,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });


});


