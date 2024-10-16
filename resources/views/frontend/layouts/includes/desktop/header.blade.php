<header>

    {{-- menu top --}}
    <div class="top-navigation">
        <div class="container">
            <ul>

                {!! widget('frontend.widget.desktop._menu_top') !!}
                @if(!auth()->guard('frontend')->check())
                    <li><a href="/login" >Đăng nhập</a></li>
                @else

                    <li class="member">
                        <i class="icon-account"></i> <a class="account" href="/account/index"><strong>{{auth()->guard('frontend')->user()->username}}</strong></a>
                        <div class="sub">
                            <ul>
                                <li><a href="/account/index"><i class="fas fa-sliders-h"></i><span> Bảng điều khiển</span></a></li>
                                <li><a href="/account/info"><i class="fas fa-user-circle" ></i><span> Thông tin tài khoản</span></a></li>
                                <li><a href="/account/order"><i class="fas fa-box-open" ></i><span> Đơn hàng của bạn</span></a></li>
                                <li><a href="/account/wishlist"><i class="fas fa-heart"></i><span> Sản phẩm yêu thích</span></a></li>
{{--                                <li><a href="/account/comment"><i class="fas fa-comments"></i><span> Quản lý bình luận</span></a></li>--}}
                                <li>
                                        <a href="/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif


            </ul>
        </div>
    </div>

    <!-- logo and search box -->
    <div class="heading">
        <div class="container">
            <div class="logo">
                <a href="/" >

                    <img src="{{\App\Library\Files::media(setting('sys_logo'))}}">
                </a>
            </div>
            <div class="search-box">
                <form method="get" action="/item-list" class="formSearchHeader"  enctype="application/x-www-form-urlencoded">
                    <div class="border">
                        <input type="text" id="searchFrom"  name="q" placeholder="Hôm nay bạn cần tìm gì?"  autocomplete="off" />
                        <button type="submit" ><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="autocomplete-suggestions hihi" style=" ">
                <div class="autocomplete-suggestion" id="result-search">
{{--                    <div class="search-item">--}}
{{--                        <div class="img">--}}
{{--                            <img src="https://cdn.hoanghamobile.com/i/productlist/ts/Uploads/2022/01/04/s21-fe-13.png" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="info">--}}
{{--                            <h2><a href="">Apple AirPods 2 - Case sạc thường chính hãng VN/A (MV7N2VN/A)</a></h2>--}}
{{--                            <h3>--}}
{{--                                <strike></strike>--}}
{{--                                2750000--}}
{{--                            </h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="search-item">--}}
{{--                        <div class="img">--}}
{{--                            <img src="https://cdn.hoanghamobile.com/i/productlist/ts/Uploads/2022/01/04/s21-fe-13.png" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="info">--}}
{{--                            <h2><a href="">Apple AirPods 2 - Case sạc thường chính hãng VN/A (MV7N2VN/A)</a></h2>--}}
{{--                            <h3>--}}
{{--                                <strike></strike>--}}
{{--                                2750000--}}
{{--                            </h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                </div>
            </div>

            <script>


            </script>
            <div class="order-tools">
                <div class="item check-order">
                    <a id="btnCheckOrder" href="/account/order">
                        <span class="icon"><i class="fas fa-truck"></i></span>
                        <span class="text">Kiểm tra đơn hàng</span>
                    </a>
                </div>
                <div class="item cart">
                    <a href="/cart"><i class="fas fa-shopping-cart"></i>
                        <label><i class="fas fa-caret-left"></i>
                            <span id="cart-total">
                                <b>
                                    @php
                                        if (Cookie::has('shopping_cart')){
                                            $data_shopping_cart = collect(json_decode(Cookie::get('shopping_cart')));
                                            $count_shopping_cart = $data_shopping_cart->sum('qty');
                                        }
                                        else{
                                            $count_shopping_cart = 0;
                                        }
                                        echo $count_shopping_cart;
                                    @endphp
                                </b>
                            </span>
                        </label>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {!! widget('frontend.widget.desktop._menu') !!}

</header>




