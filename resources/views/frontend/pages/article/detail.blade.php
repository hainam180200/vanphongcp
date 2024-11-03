@extends('frontend.layouts.master')
@section('content')
<!-- content-->
<div class="row mx-0 c-p-8">
    <div class="col-lg-8">
        <div class="c-py-12">
            <h5>
                {{$data->title ?? ''}}
            </h5>
            <p class="text-right font-italic t-body-1 fz-12">{{isset($data) ? $data->created_at->format('d/m/Y') : ''}}</p>
               <div class="news-detail">
                {!! $data->content !!}
            </div>
        </div>

    </div>
    <div class="col-lg-4 c-mt-lg-8 c-px-lg-4">
        <!-- văn bản mới-->
        <!-- văn bản mới-->
        {!! widget('frontend.widget._article') !!}
        {!! widget('frontend.widget._section_widget_slide_ads') !!}
        {!! widget('frontend.widget._section_widget_iframe_right_1') !!}

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
