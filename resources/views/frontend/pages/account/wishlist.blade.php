@extends('frontend.layouts.master')
@section('content')
    <section class="account">

        @include('frontend.pages.account.sidebar')
        <div class="body-content">



            <h1>Sản phẩm y&#234;u th&#237;ch</h1>

            <div class="header">
                <div class="bg">
                    <div class="text">
                        <h2>CHÀO MỪNG QUAY TRỞ LẠI, {{ isset($user)? $user->username : "" }}</h2>
                        <p><i>Xem và kiểm tra những sản phẩm yêu thích của bạn tại đây</i></p>
                    </div>
                </div>
                <div class="icon">
                    <img src="/assets/frontend/image/account_3.png" style="margin-bottom:-26px;"/>

                </div>
            </div>



            <div class="account-layout">
                <div style="max-width:100%; padding:30px;">

                    <div class="lts-product col-product ">
                        @if(isset($favorite) && count($favorite)>0)
                            @foreach ($favorite as $key => $item)
                                <div class="item">
                                    <div class="img">
                                        <a href="/{{isset($item->item->url) ? $item->item->url : $item->item->slug}}">
                                            <img src="{{ isset($item->item->image)?\App\Library\Files::media($item->item->image) : null }}" alt="{{isset($item->item->title) ? $item->item->title : null}}">
                                        </a>
                                    </div>

                                    {{--                                    <div class="sticker sticker-left">--}}
                                    {{--                                        <span><img src="/Content/web/sticker/apple.png" title="Ch&#237;nh h&#227;ng Apple" /></span>--}}
                                    {{--                                    </div>--}}
                                    <div class="info">
                                        <a href="/{{isset($item->item->url) ? $item->item->url : $item->item->slug}}" class="title" title="{{isset($item->item->title) ? $item->item->title : null}}">{{isset($item->item->title) ? $item->item->title : null}}</a>
                                        <span class="price">
                                              <strong>{{number_format($item->item->price)}} ₫</strong>
                                               @if (isset($item->item->percent_sale) && (int)$item->item->percent_sale > 0)
                                                <strike>{{number_format($item->item->price_old)}} ₫</strike>
                                            @endif
                                         </span>
                                    </div>
                                    @if (isset($item->item->promotion) && $item->item->promotion != "")
                                        <div class="note">
                                            <span class="bag">KM</span> <label title="{{json_decode($item->item->promotion)[0]}}">{{\Str::limit(json_decode($item->item->promotion)[0],32)}}</label>
                                            @if (count(json_decode($item->item->promotion)) > 1)
                                                <strong class="text-orange">VÀ {{count(json_decode($item->item->promotion)) - 1}} KM KHÁC</strong>
                                            @endif
                                        </div>
                                    @endif
                                    @if (isset($item->item->promotion) && $item->item->promotion != "")
                                        <div class="promote">
                                            <a href="/{{isset($item->item->url) ? $item->item->url : $item->item->slug}}">
                                                <ul>
                                                    @foreach (json_decode($item->item->promotion) as $item)
                                                        <li><span class="bag">KM</span> {{$item}}</li>
                                                    @endforeach
                                                </ul>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <p>Bạn chưa có sản phẩm yêu thích</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.activefavorite').addClass('active')
            })
        </script>
    </section>
@endsection

