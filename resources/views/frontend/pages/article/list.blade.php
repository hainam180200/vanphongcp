@extends('frontend.layouts.master')
@section('content')
<!-- content-->
<div class="row mx-0 c-p-8">
    <div class="col-lg-8">
        <div class="news-list">
            @include('frontend.pages.article.func.load_item')
        </div>

    </div>
    <div class="col-lg-4 c-mt-lg-8 c-px-lg-4">
        <!-- văn bản mới-->
        <div class="steering-scroll">
            <div class="steering-header">
                <a href="" class="c-pl-30 fw-600 text-uppercase lh-26 text-white"> Thông tin mới nhất </a>
            </div>
            <div class="steering-scroll-list c-p-10">
                <ul>
                    <li>
                        <a href="" class="d-flex" title="Kế hoạch tuyên truyền, phổ biến các văn bản pháp luật mới được Quốc hội khoá XV thông qua tại kỳ họp lần thứ 4, kỳ họp bất thường lần thứ 2">
                            <div class="c-mr-4">
                                <img src="image/star.png" loading="lazy">
                            </div>
                            <span class="text-limit limit-3 t-body-1">Tỉnh táo nhận diện và phản bác những luận điệu xuyên tạc của các thế lực thù địch về phòng, chống...</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="d-flex" title="Kế hoạch tuyên truyền, phổ biến các văn bản pháp luật mới được Quốc hội khoá XV thông qua tại kỳ họp lần thứ 4, kỳ họp bất thường lần thứ 2">
                            <div class="c-mr-4">
                                <img src="image/star.png" loading="lazy">
                            </div>
                            <span class="text-limit limit-3 t-body-1">Tỉnh táo nhận diện và phản bác những luận điệu xuyên tạc của các thế lực thù địch về phòng, chống...</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="d-flex" title="Kế hoạch tuyên truyền, phổ biến các văn bản pháp luật mới được Quốc hội khoá XV thông qua tại kỳ họp lần thứ 4, kỳ họp bất thường lần thứ 2">
                            <div class="c-mr-4">
                                <img src="image/star.png" loading="lazy">
                            </div>
                            <span class="text-limit limit-3 t-body-1">Tỉnh táo nhận diện và phản bác những luận điệu xuyên tạc của các thế lực thù địch về phòng, chống...</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="d-flex" title="Kế hoạch tuyên truyền, phổ biến các văn bản pháp luật mới được Quốc hội khoá XV thông qua tại kỳ họp lần thứ 4, kỳ họp bất thường lần thứ 2">
                            <div class="c-mr-4">
                                <img src="image/star.png" loading="lazy">
                            </div>
                            <span class="text-limit limit-3 t-body-1">Tỉnh táo nhận diện và phản bác những luận điệu xuyên tạc của các thế lực thù địch về phòng, chống...</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- văn bản mới-->
        {!! widget('frontend.widget._document') !!}
        {!! widget('frontend.widget._section_widget_slide_ads') !!}
        {!! widget('frontend.widget._section_widget_iframe_right_1') !!}
        <div class="ads-container mt-2">
            <div class="steering-header">
                <a href="" class="c-pl-30 fw-600 text-uppercase lh-26 text-white"> Thống kê truy cập </a>
            </div>
            <div class="ads-content c-p-10">
                <span>Đang online: 1</span>
                <br>
                <span>Hôm nay: 125</span>
                <br>
                <span>Tất cả: 65656</span>
                <br>
            </div>
        </div>
        <div class="ads-container mt-2">
            <div class="steering-header">
                <a href="" class="c-pl-30 fw-600 text-uppercase lh-26 text-white"> Liên kết website </a>
            </div>
            <div class="ads-content c-p-10">
                <select name="" id="">
                    <option value="">6565</option>
                    <option value="">6565</option>
                    <option value="">6565</option>
                    <option value="">6565</option>
                    <option value="">6565</option>
                </select>
            </div>
        </div>
        {!! widget('frontend.widget._section_widget_iframe_right_2') !!}

    </div>
</div>
@endsection
