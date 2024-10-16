@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('content')
<!-- slider -->
{!! widget('frontend.widget.mobile._slide') !!}


{!! widget('frontend.widget.mobile._banner_sales') !!}

{!! widget('frontend.widget.mobile._flash_sales') !!}


{!! widget('frontend.widget.mobile._section_widget_1') !!}


{!! widget('frontend.widget.mobile._section_widget_2') !!}


{!! widget('frontend.widget.mobile._section_widget_3') !!}


{!! widget('frontend.widget.mobile._section_widget_category') !!}

{!! widget('frontend.widget.desktop._intro_text') !!}


{!! widget('frontend.widget.mobile._section_widget_article') !!}


{!! widget('frontend.widget.mobile._section_widget_banner_nature') !!}

@endsection
