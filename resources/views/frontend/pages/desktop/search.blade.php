@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('content')
    {{--    quảng cáo--}}
    {!! widget('frontend.widget.desktop._ads_1') !!}

    {{--tiêu đề--}}
    <section>
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="/"><span itemprop="name" content="Trang chủ"><i class="fas fa-home"></i> Trang chủ</span></a>
                    <meta itemprop="position" content="1" />
                </li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href=""><span itemprop="name" content="Tìm kiếm">Tìm kiếm</span></a>
                    <meta itemprop="position" content="" />
                </li>

            </ol>
        </div>
    </section>
    {{--filter lọc--}}
    <section>
        <div class="container">
            <div class="product-filters2">
                <div class="left">
                    <strong class="label">Lọc danh sách:</strong>
                    @if (isset($alltempParrentId) && count($alltempParrentId) > 0)
                        <div class="facet">
                            <label><a href="javascript:;">Danh mục <i class="fas fa-chevron-down"></i></a></label>
                            <div class="sub">
                                <ul>
                                    @foreach ($alltempParrentId as $item)
                                        <li><a href="{{isset($item->url) ? $item->url : $item->slug}}">{{$item->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="facet">
                        <label>
                            <a href="javascript:;">Gi&#225; <i class="fas fa-chevron-down"></i></a>
                        </label>
                        <div class="sub">
                            <ul>
                                <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','0-1000000')}}">Dưới 1 triệu</a></li>
                                <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','1000000-3000000')}}">Từ 1 đến 3 triệu</a></li>
                                <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','3000000-5000000')}}">Từ 3 đến 5 triệu</a></li>
                                <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','5000000-10000000')}}">Từ 5 đến 10 triệu</a></li>
                                <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','10000000-12000000')}}">Từ 10 đến 12 triệu</a></li>
                                <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','12000000-15000000')}}">Từ 12 đến 15 triệu</a></li>
                                <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','15000000-20000000')}}">Từ 15 đến 20 triệu</a></li>
                                <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','20000000-50000000')}}">Từ 20 đến 50 triệu</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="facet">
                        <label>Sắp xếp <i class="fas fa-chevron-down"></i></label>
                        <div class="sub">
                            <ul>
                                @if (config('module.product.sort') && count(config('module.product.sort')) > 0)
                                    @foreach (config('module.product.sort') as $key => $item)
                                        <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'sort',$key)}}">{{$item}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--sản phẩm--}}
    <section>
        <div class="container">
            <a name="page_1"></a>
            <div class="list-product">
                <h1>Tìm kiếm</h1>
                @if (isset($items_prd) && count($items_prd) > 0)
                    <div class="col-content lts-product lts-product-load-item">
                        @foreach ($items_prd as $item)
                            <div class="item">
                                <div class="img">
                                    <a href="{{isset($item->url) ? $item->url : $item->slug}}" title="{{isset($item->title) ? $item->title : null}}">
                                        <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" alt="{{isset($item->title) ? $item->title : null}}">
                                    </a>
                                </div>
                                @if (isset($item->percent_sale) && (int)$item->percent_sale > 0)
                                    <div class="cover">
                                        <div style="color: yellow;
                                     background: #f63;
                                     margin: 25px 20px 15px 15px;
                                     padding: 3px;
                                     border-radius: 6px;
                                     font-size:10px;
                                     font-weight: 600;">
                                            <span style="color:white">Khuyến mại giá sốc </span><br>
                                            <span style="color:yellow"> {{number_format($item->price)}} đ</span><br>
                                        </div>
                                    </div>
                                @endif
                                <div class="info">
                                    <a href="{{isset($item->url) ? $item->url : $item->slug}}" class="title" title="{{isset($item->title) ? $item->title : null}}">{{isset($item->title) ? $item->title : null}}</a>
                                    <span class="price">
                               <strong>{{number_format($item->price)}} ₫</strong>
                               @if (isset($item->percent_sale) && (int)$item->percent_sale > 0)
                                            <strike>{{number_format($item->price_old)}} ₫</strike>
                                        @endif
                               </span>
                                </div>
                                @if (isset($item->promotion) && $item->promotion != "")
                                    <div class="note">
                                        <span class="bag">KM</span> <label title="{{json_decode($item->promotion)[0]}}">{{\Str::limit(json_decode($item->promotion)[0],32)}}</label>
                                        @if (count(json_decode($item->promotion)) > 1)
                                            <strong class="text-orange">VÀ {{count(json_decode($item->promotion)) - 1}} KM KHÁC</strong>
                                        @endif
                                    </div>
                                @endif
                                @if (isset($item->promotion) && $item->promotion != "")
                                    <div class="promote">
                                        <a href="{{isset($item->url) ? $item->url : $item->slug}}">
                                            <ul>
                                                @foreach (json_decode($item->promotion) as $item)
                                                    <li><span class="bag">KM</span> {{$item}}</li>
                                                @endforeach
                                            </ul>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div id="page-holder"></div>
            {{-- @if (isset($items_prd) && count($items_prd) > 0)
                <div class="col-md-12 col-lg-12 col-xl-12 nav-pagination" style=" text-align: center; ">
                    {{ $items_prd->appends(request()->query())->links() }}
                </div>
            @endif --}}
            <div class="more-product" id="page-pager">
                <a href="{{\Request::fullUrl()}}" id="paginate">Xem thêm</a>
            </div>
        </div>
    </section>
    @if (isset($data->content))
        <section>
            <div class="container">
                <div class="page-content page-content-img">
                    {!! $data->content !!}
                </div>
            </div>
        </section>
    @endif
    {!! widget('frontend.widget.desktop._section_widget_banner_nature') !!}
    <script>
        $( document ).ready(function() {
            var page = 1;
            $('body').on('click','#paginate',function(e){
                e.preventDefault()
                var url = $(this).attr('href');
                page++;
                load_more_prd(page,url);
            })
            function load_more_prd(page,url) {
                $.ajax({
                    url: url+'&page=' + page,
                    type: "get",
                    datatype: "html",
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $(".more-product").hide();
                        }
                        $(".lts-product-load-item").append(data);
                    },
                    complete: function() {

                    }
                })
            }
        });
    </script>
@endsection
