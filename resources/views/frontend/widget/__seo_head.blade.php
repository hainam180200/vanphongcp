<meta charset="utf-8"/>
@if (isset($data->title))
<title>{{$data->title}}</title>
@else
    <title id="metatitle">{{setting('sys_title')}}</title>
@endif
@if (isset($data->seo_description))
    <meta name="description" content="{{$data->seo_description}}">      
@else    
    <meta name="description" content="{{setting('sys_description')}}">      
@endif

@if (isset($data->seo_keyword))
    <meta name="keywords" content="{{$data->seo_keyword}}">
@else
    <meta name="keywords" content="{{setting('sys_keyword')}}">
@endif

<link rel="shortcut icon" href="{{\App\Library\Files::media(setting('sys_favicon')) }}" type="image/x-icon">
<meta content="{{\Request::getHost()}}" name="author"/>
<meta name="robots" content="index,follow" />
<meta name="author" content="{{\Request::getHost()}}"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website"/>
<meta property="og:url" content="{{url()->current()}}"/>
@if (isset($data->title))
    <meta property="og:title" content="{{$data->title}}">
@else
    <meta property="og:title" content="{{setting('sys_title')}}">
@endif

@if (isset($data->seo_description))
    <meta property="og:description" content="{{$data->seo_description}}">      
@else    
    <meta property="og:description" content="{{setting('sys_description')}}">      
@endif
@if (isset($data->image))
    <meta property="og:image" content="https://{{\Request::getHost()}}{{\App\Library\Files::media($data->image)}}">    
@else  
    <meta property="og:image" content="https://{{\Request::getHost()}}{{setting('sys_logo')}}">    
@endif
