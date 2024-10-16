@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('content')
    {!! widget('frontend.widget.desktop._slide') !!}

    {!! widget('frontend.widget.desktop._banner_sales') !!}

    {{-- _flash_sales --}}
    {!! widget('frontend.widget.desktop._flash_sales') !!}

    {{-- @include('frontend.widget.desktop._flash_sales') --}}

    {{-- ads 1 --}}
    {!! widget('frontend.widget.desktop._ads_1') !!}

    {!! widget('frontend.widget.desktop._section_widget_1') !!}

    {{-- ads 2 --}}
    {!! widget('frontend.widget.desktop._ads_2') !!}

    {!! widget('frontend.widget.desktop._section_widget_2') !!}


    {{-- ads 3 --}}
    {!! widget('frontend.widget.desktop._ads_3') !!}

    {!! widget('frontend.widget.desktop._section_widget_3') !!}

    {{-- ads 4 --}}

    {!! widget('frontend.widget.desktop._ads_4') !!}

    {!! widget('frontend.widget.desktop._section_widget_category') !!}

    {!! widget('frontend.widget.desktop._intro_text') !!}

    {!! widget('frontend.widget.desktop._section_widget_article') !!}

    {!! widget('frontend.widget.desktop._section_widget_banner_nature') !!}




@endsection
