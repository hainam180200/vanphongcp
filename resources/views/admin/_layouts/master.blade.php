<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
<head>
    <meta charset="utf-8"/>

    {{-- Title Section --}}
    <title> Quản lý hệ thống | @yield('title', $page_breadcrumbs[0]['title'] ?__($page_breadcrumbs[0]['title']): '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/backend/themes/media/logos/favicon.ico') }}" />

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}

    {{-- Global Theme Styles (used by all pages) --}}
    @foreach(config('layout.resources.css') as $style)
        <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
    @endforeach

    {{-- Layout Themes (used by all pages) --}}
    @foreach (Metronic::initThemes() as $theme)
        <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
    @endforeach
 

    {{-- Includable CSS --}}
    @yield('styles')
    <link rel="stylesheet" href="/assets/backend/jasny-bootstrap/css/jasny-bootstrap.min.css">
    <script src="/assets/backend/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/backend/jasny-bootstrap/js/jasny-bootstrap.js"></script>
</head>
<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

@if (config('layout.page-loader.type') != '')
    @include('admin._layouts.partials._page-loader')
@endif

@include('admin._layouts.base._layout')
<div class="modal fade" id="LoadModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{__('Đang tải dữ liệu...')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

            </div>


        </div>
    </div>
</div>



<script>
    var HOST_URL = "{{ url()->current() }}";
    {{--var ROOT_DOMAIN = "{{Request::getSchemeAndHttpHost()}}"--}}
    var ROOT_DOMAIN = "{{env('FRONTEND_URL')}}";
    var MEDIA_URL = "{{ config('module.media.url')}}";

</script>


{{-- Global Config (global config for global JS scripts) --}}
<script>
    var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>

{{-- Global Theme JS Bundle (used by all pages)  --}}
@foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach

{{-- Includable JS --}}
@yield('scripts')

<script>
    $(document).ready(function () {


        $('body').on('click', '.load-modal', function(e) {
            e.preventDefault();
            var curModal = $('#LoadModal');
            curModal.find('.modal-content .modal-body').html("<div class=\" overlay overlay-block\"><div class=\"overlay-layer rounded bg-primary-o-20\"><div class=\"spinner spinner-track spinner-primary mr-15 \"></div></div></div>");
            // curModal.find('.modal-content .modal-body').html("<div class=\"overlay-layer bg-dark-o-10\"><div class=\"spinner spinner-track spinner-primary mr-15 \"></div></div>");
            curModal.modal('show').find('.modal-content').load($(e.target).attr('rel'));

        });

    });
</script>

@include('admin._layouts.includes.notifications')
</body>
</html>

