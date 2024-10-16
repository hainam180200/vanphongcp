@extends('frontend.layouts.master')
@section('content')
<section>
   <div class="container">
      <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
         <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="/"><span itemprop="name" content="Trang chủ"><i class="fas fa-home"></i> Trang chủ</span></a>
            <meta itemprop="position" content="1" />
         </li>
         <li><i class="fas fa-chevron-right"></i></li>
         <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="/san-pham-da-xem" title="Sản phẩm đ&#227; xem" class="actived"><span itemprop="name" content="Sản phẩm đ&#227; xem">Sản phẩm đ&#227; xem</span></a>
            <meta itemprop="position" content="2" />
         </li>
      </ol>
   </div>
</section>
<section>
   <div class="container">
      <div class="list-product">
         <h1>Sản phẩm đ&#227; xem</h1>
         <div class="lts-product col-product">
            @if (isset($data) && count($data) > 0)
                @foreach ($data as $item)
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
            @else
            <div class="">
                <p style="text-align: center;">Bạn chưa xem sản phẩm nào</p>
            </div>
            @endif
         </div>
      </div>
   </div>
</section>
@endsection