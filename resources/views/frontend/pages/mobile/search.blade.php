@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('content')
    {{--filter lọc--}}
    <section class="product-filters2">
        <div class="container">
            <div>
                <h3>Lọc danh sách:</h3>
                {{--  Danh mục--}}
                <div class="facet">
                    <label>Danh mục </label>
                    <select onchange="window.location = this.value;">
                        <option>Tìm kiếm</option>
                    </select>
                </div>
                <div class="facet">
                    <label>Gi&#225;</label>
                    <select onchange="">
                        <option>Chọn Gi&#225;</option>
                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','0-1000000')}}">Dưới 1 triệu</option>
                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','1000000-3000000')}}">Từ 1 đến 3 triệu</option>
                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','3000000-5000000')}}">Từ 3 đến 5 triệu</option>
                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','5000000-10000000')}}">Từ 5 đến 10 triệu</option>
                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','10000000-12000000')}}">Từ 10 đến 12 triệu</option>
                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','12000000-15000000')}}">Từ 12 đến 15 triệu</option>
                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','15000000-20000000')}}">Từ 15 đến 20 triệu</option>
                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'price','20000000-50000000')}}">Từ 20 đến 50 triệu</option>
                    </select>
                </div>
                <div class="facet">
                    <label>Sắp xếp</label>
                    <select onchange="">
                        <option>Chọn cách sắp xếp</option>
                        @if (config('module.product.sort') && count(config('module.product.sort')) > 0)
                            @foreach (config('module.product.sort') as $key => $item)
                                <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'sort',$key)}}">{{$item}}</option>
                            @endforeach
                        @endif
                    </select>
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
                    <div class="lts-product col-product lts-product-load-item">
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
                                        font-size:10px
                                        font-weight: 600;">
                                            <span style="color:white">Khuyến mại giá sốc</span><br>
                                            <span style="color:yellow">{{number_format($item->price)}}</span><br>
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
                                        <strong class="text-orange">VÀ {{count(json_decode($item->promotion)) - 1}} KM KHÁC</strong>
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

            <div class="more-product" id="page-pager">
                <a href="{{\Request::fullUrl()}}" id="paginate">Xem thêm</a>
            </div>


        </div>
    </section>
    @if (isset($data->content))
        <section>
            <div class="container">
                <div class="page-content page-content-img" style="display:none;">
                    {!! $data->content !!}
                </div>
            </div>
        </section>
    @endif
    {!! widget('frontend.widget.mobile._section_widget_banner_nature') !!}
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
