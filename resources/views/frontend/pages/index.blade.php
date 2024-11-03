@extends('frontend.layouts.master')
@section('content')
<div class="row mx-0 c-p-8">
    <div class="col-lg-8">
        {!! widget('frontend.widget._slide') !!}
        {!! widget('frontend.widget._article_index_1') !!}
        {!! widget('frontend.widget._section_widget_banner_left_1') !!}
        <!--  advertise default-->
        <!--  list article-->
        <div class="row c-mt-8 d-flex flex-wrap flex-lg-nowrap ">
            {!! widget('frontend.widget._article_index_2') !!}
            {!! widget('frontend.widget._article_index_3') !!}
            {!! widget('frontend.widget._article_index_4') !!}
        </div>
        <!--  advertise default-->
        {!! widget('frontend.widget._section_widget_banner_left_2') !!}
        <!--  list article-->
        <div class="row c-mt-8 d-flex flex-nowrap">
            {!! widget('frontend.widget._article_index_image') !!}
            {!! widget('frontend.widget._article_index_video') !!}
        </div>
    </div>
    <div class="col-lg-4 c-mt-lg-8 c-px-lg-4">
        <!-- văn bản mới-->
        {!! widget('frontend.widget._document') !!}
        {!! widget('frontend.widget._section_widget_slide_ads') !!}
        {!! widget('frontend.widget._section_widget_banner_right_1') !!}

        {!! widget('frontend.widget._section_widget_iframe_right_1') !!}
        <div class="ads-container mt-2">
            <div class="steering-header">
                <a href="" class="c-pl-30 fw-600 text-uppercase lh-26 text-white"> Thống kê truy cập </a>
            </div>
            <div class="ads-content c-p-10">
                <span>Đang online: {{$onlineVisitors}}</span>
                <br>
                <span>Hôm nay: {{$todayVisits}}</span>
                <br>
                <span>Trong tuần: {{$weekVisits}}</span>
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
