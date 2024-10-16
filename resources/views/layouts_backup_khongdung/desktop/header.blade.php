<header>
    <div class="top-navigation">
        <div class="container">
            <ul>
                <li><a href=/device-switch/{switch}=true">Bản mobile</a></li>
                <li><a href="/">Giới thiệu</a></li>
                <li><a href="/san-pham-da-xem">Sản phẩm đ&#227; xem</a></li>
                <li><a href="/">Trung t&#226;m bảo h&#224;nh</a></li>
                <li><a href="/">Hệ thống 86 si&#234;u thị</a></li>
                <li><a href="/">Tuyển dụng</a></li>
                <li><a href="/order">Tra cứu đơn h&#224;ng</a></li>
                @if (!auth()->check())
                <li><a href="/login" >Đăng nhập</a></li>
                @else
                <li><a href="{{route('logout')}}" invalidate-session="true" delete-cookies="true" onclick="sessionStorage.removeItem('_userConnect');">Đăng xuất</a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- logo and search box -->
    <div class="heading">
        <div class="container">
            <div class="logo">
                <a href="/" >
                    <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png">
                </a>
            </div>
            <div class="search-box">
                <form method="get" action="/tim-kiem" onsubmit="return submitSearch(this);" enctype="application/x-www-form-urlencoded">
                    <div class="border">
                        <input type="text" id="kwd" name="kwd" placeholder="Hôm nay bạn cần tìm gì?" />
                        <button type="submit" class="search"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="order-tools">
                <div class="item check-order">
                    <a id="btnCheckOrder" href="/account/order">
                        <span class="icon"><i class="fas fa-truck"></i></span>
                        <span class="text">Kiểm tra đơn hàng</span>
                    </a>
                </div>
                <div class="item cart">
                    <a href="/cart"><i class="fas fa-shopping-cart"></i><label><i class="fas fa-caret-left"></i><span id="cart-total">0</span></label></a>
                </div>
            </div>
        </div>
    </div>
    <!-- nav -->
    <nav>
        <div class="container">
            <ul class="root">
                <li id="dien-thoai-di-dong">
                    <a href="/category" target="_self">

                        <img src="/assets/frontend/image/iphone.svg" class="filter-green" />
                        <span>Điện thoại</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g1">
                                <h4><a href="/dien-thoai-di-dong">H&#227;ng sản xuất</a></h4>
                                <ul class="display-column format_3">
                                    <li><a href="/category">iPhone</a></li>
                                    <li><a href="/category">XOR</a></li>
                                    <li><a href="/category">Samsung</a></li>
                                    <li><a href="/category">Xiaomi</a></li>
                                    <li><a href="/category">realme</a></li>
                                    <li><a href="/category">Nokia</a></li>
                                    <li><a href="/category">OPPO</a></li>
{{--                                    <li><a href="/dien-thoai-di-dong/blackberry">Blackberry</a></li>--}}
{{--                                    <li><a href="/dien-thoai-di-dong/vivo">Vivo</a></li>--}}
{{--                                    <li><a href="/dien-thoai-di-dong/energizer">Energizer</a></li>--}}
{{--                                    <li><a href="/dien-thoai-di-dong/masstel">Masstel</a></li>--}}
{{--                                    <li><a href="/dien-thoai-di-dong/philips">Philips</a></li>--}}
{{--                                    <li><a href="/dien-thoai-di-dong/itel">Itel</a></li>--}}
{{--                                    <li><a href="/dien-thoai-di-dong/bphone">BPhone</a></li>--}}
{{--                                    <li><a href="/dien-thoai-di-dong/tecno">TECNO</a></li>--}}
                                </ul>
                                <h4><a href="/category">Điện thoại cao cấp</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                            </div>
                            <div class="menu g2">
                                <h4><a href="/category">Mức gi&#225;</a></h4>
                                <ul class="display-row format_2">
                                    <li><a href="/category">Tr&#234;n 100 triệu</a></li>
                                    <li><a href="/category">Dưới 1 triệu</a></li>
                                    <li><a href="/category">Từ 2 đến 3 triệu</a></li>
                                    <li><a href="/category">Từ 3 đến 4 triệu</a></li>
                                    <li><a href="/category">Từ 6 đến 8 triệu</a></li>
                                    <li><a href="/category">Từ 15 đến 20 triệu</a></li>
                                    <li><a href="/category">Từ 20 đến 100 triệu</a></li>
                                </ul>
                            </div>
                            <div class="menu g3">
                                <h4><a>Quan t&#226;m nhất</a></h4>
                                <ul class="display-row format_2">
                                    <li><a href="/category">H&#244;m nay</a></li>
                                    <li><a href="/category">Tuần n&#224;y</a></li>
                                    <li><a href="/category">Th&#225;ng n&#224;y</a></li>
                                    <li><a href="/category">Năm nay</a></li>
                                </ul>
                            </div>
                            <div class="menu ads" style="width:360px">
                            </div>
                        </div>
                    </div>
                </li>
                <li id="dong-ho">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/watch.svg" class="filter-green" />
                        <span>Đồng hồ</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g0">
                                <h4><a>Đồng hồ</a></h4>
                                <ul class="display-column format_4">
                                    <li><a href="/category">Apple Watch</a></li>
                                    <li><a href="/category">Samsung</a></li>
                                    <li><a href="/category">Xiaomi</a></li>
                                    <li><a href="/category">Garmin</a></li>
                                    <li><a href="/category">Tic Watch</a></li>
                                    <li><a href="/category">Amazfit</a></li>
                                    <li><a href="/category">Đồng hồ trẻ em</a></li>
                                    <li><a href="/category">Huawei </a></li>
{{--                                    <li><a href="/dong-ho/masstel">Masstel</a></li>--}}
{{--                                    <li><a href="/dong-ho/oppo">OPPO</a></li>--}}
{{--                                    <li><a href="/dong-ho/realme">realme</a></li>--}}
{{--                                    <li><a href="/dong-ho/top-vong-deo-tay">Top v&#242;ng đeo tay</a></li>--}}
{{--                                    <li><a href="/dong-ho/fitbit">Fitbit</a></li>--}}
                                </ul>
                            </div>
                            <div class="menu ads" style="width:400px">
                            </div>
                        </div>
                    </div>
                </li>
                <li id="laptop">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/laptop.svg" class="filter-green" />
                        <span>Laptop</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g0">
                                <h4><a href="/category">MacBook</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">ASUS</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">Dell</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">HP</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">iMac 2021</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">Lenovo</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">Microsoft</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                            </div>
                            <div class="menu ads" style="width:600px">
                            </div>
                        </div>
                    </div>
                </li>
                <li id="tablet">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/tablet.svg" class="filter-green" />
                        <span>Tablet</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g0">
                                <h4><a href="/category">Lenovo</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">Microsoft</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">Nokia</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">iPad</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">Samsung</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">Xiaomi</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                                <h4><a href="/category">Huawei</a></h4>
                                <ul class="display-column format_0">
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="loa-tai-nghe">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/headphone.svg" class="filter-green" />
                        <span>&#194;m thanh</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g0">
                                <h4><a href="/category">Loa</a></h4>
                                <ul class="display-column format_2">
                                    <li><a href="/category">Energizer</a></li>
                                    <li><a href="/category">Huawei</a></li>
                                    <li><a href="/category">LG</a></li>
                                    <li><a href="/category">Marshall</a></li>
{{--                                    <li><a href="/loa/soundpeats">SoundPEATS</a></li>--}}
{{--                                    <li><a href="/loa/tekin">Tekin</a></li>--}}
{{--                                    <li><a href="/loa/jbl">JBL</a></li>--}}
{{--                                    <li><a href="/loa/harman-kardon">Harman Kardon</a></li>--}}
{{--                                    <li><a href="/loa/sony">Sony</a></li>--}}
{{--                                    <li><a href="/loa/samsung">Samsung</a></li>--}}
{{--                                    <li><a href="/loa/apple">Apple</a></li>--}}
{{--                                    <li><a href="/loa/divoom">Divoom</a></li>--}}
{{--                                    <li><a href="/loa/anker">Anker</a></li>--}}
                                </ul>
                            </div>
                            <div class="menu g1">
                                <h4><a href="/tai-nghe">Tai nghe</a></h4>
                                <ul class="display-column format_3">
                                    <li><a href="/category">Sony</a></li>
                                    <li><a href="/category">JBL</a></li>
                                    <li><a href="/category">Soundpeats</a></li>
                                    <li><a href="/category">AKG</a></li>
{{--                                    <li><a href="/tai-nghe/apple-airpods">Apple AirPods</a></li>--}}
{{--                                    <li><a href="/tai-nghe/beats">Beats</a></li>--}}
{{--                                    <li><a href="/tai-nghe/energizer">Energizer</a></li>--}}
{{--                                    <li><a href="/tai-nghe/huawei">Huawei</a></li>--}}
{{--                                    <li><a href="/tai-nghe/iwalk">iWalk</a></li>--}}
{{--                                    <li><a href="/tai-nghe/lg">LG</a></li>--}}
{{--                                    <li><a href="/tai-nghe/motorola">Motorola</a></li>--}}
{{--                                    <li><a href="/tai-nghe/nokia">Nokia</a></li>--}}
{{--                                    <li><a href="/tai-nghe/oppo">OPPO</a></li>--}}
{{--                                    <li><a href="/tai-nghe/philips">PHILIPS</a></li>--}}
{{--                                    <li><a href="/tai-nghe/pioneer">Pioneer</a></li>--}}
{{--                                    <li><a href="/tai-nghe/pisen">Pisen</a></li>--}}
{{--                                    <li><a href="/tai-nghe/plantronics">Plantronics</a></li>--}}
{{--                                    <li><a href="/tai-nghe/realme">realme</a></li>--}}
{{--                                    <li><a href="/tai-nghe/samsung">Samsung</a></li>--}}
{{--                                    <li><a href="/tai-nghe/sennheiser">Sennheiser</a></li>--}}
{{--                                    <li><a href="/tai-nghe/xiaomi">Xiaomi</a></li>--}}
                                </ul>
                            </div>
                            <div class="menu ads" style="width:600px">
                            </div>
                        </div>
                    </div>
                </li>
                <li id="smart-home">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/home.svg" class="filter-green" />
                        <span>Smart Home</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g4">
                                <h4><a href="/smart-home">Gia dụng th&#244;ng minh</a></h4>
                                <ul class="display-row format_2">
                                    <li><a href="/category">M&#225;y lọc kh&#244;ng kh&#237;</a></li>
                                    <li><a href="/category">Robot h&#250;t bụi</a></li>
                                    <li><a href="/category">Phụ kiện gia dụng</a></li>
                                    <li><a href="/category">FPT Play box</a></li>
                                    <li><a href="/category">C&#226;n th&#244;ng minh</a></li>
                                    <li><a href="/category">Ổ Cắm điện</a></li>
                                    <li><a href="/category">Thiết bị định vị th&#244;ng minh</a></li>
                                    <li><a href="/category">Camera an ninh</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="phu-kien">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/sac.svg" class="filter-green" />
                        <span>Phụ kiện</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g0">
                                <h4><a href="/category">Xả tồn phụ kiện - GI&#193; SỐC</a></h4>
                                <ul class="display-column format_1">
                                </ul>
                                <h4><a href="/category">Phụ kiện Apple</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                                <h4><a href="/category">Phụ Kiện M&#225;y T&#237;nh</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                                <h4><a href="/category">Sạc dự ph&#242;ng</a></h4>
                                <ul class="display-row format_1">
                                    <li><a href="/category">Top Ưu Đ&#227;i Hot Sạc Dự Ph&#242;ng</a></li>
                                </ul>
                                <h4><a href="/category">Củ sạc, d&#226;y c&#225;p</a></h4>
                                <ul class="display-column format_2">
                                </ul>
                            </div>
                            <div class="menu g4">
                                <h4><a href="/category">Robot h&#250;t bụi</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                                <h4><a href="/category">M&#225;y lọc kh&#244;ng kh&#237;</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                                <h4><a href="/category">Tay cầm chống rung</a></h4>
                                <ul class="display-row format_1">
                                </ul>
{{--                                <h4><a href="/do-choi-cong-nghe/gopro">Camera h&#224;nh tr&#236;nh</a></h4>--}}
{{--                                <ul class="display-row format_1">--}}
{{--                                </ul>--}}
                            </div>
                            <div class="menu g3">
                                <h4><a href="/category">T&#250;i x&#225;ch</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                                <h4><a href="/category">Loa</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                                <h4><a href="/category">B&#250;t cảm ứng</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                                <h4><a href="/category">Tai nghe</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                                <h4><a href="//category">Phụ kiện học sinh</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                            </div>
                            <div class="menu g1">
                                <h4><a href="/category">D&#226;y đeo đồng hồ</a></h4>
                                <ul class="display-column format_1">
                                </ul>
                                <h4><a href="/category">Miếng d&#225;n m&#224;n h&#236;nh</a></h4>
                                <ul class="display-column format_1">
                                </ul>
                                <h4><a href="/category">Camera an ninh</a></h4>
                                <ul class="display-row format_1">
                                </ul>
                                <h4><a href="/category">Bộ ph&#225;t wifi</a></h4>
                                <ul class="display-column format_1">
                                </ul>
                            </div>
                            <div class="menu g2">
                                <h4><a href="/category">Thẻ nhớ - USB</a></h4>
                                <ul class="display-column format_1">
                                </ul>
                                <h4><a href="/category">Bao da - Ốp lưng</a></h4>
                                <ul class="display-column format_2">
                                </ul>
                                <h4><a href="/category">Thay Pin, M&#224;n h&#236;nh ch&#237;nh h&#227;ng</a></h4>
                                <ul class="display-column format_1">
                                    <li><a href="/category">M&#224;n h&#236;nh iPhone</a></li>
                                    <li><a href="/category">Pin iPhone</a></li>
                                </ul>
                            </div>
                            <div class="menu ads" style="width:300px">
                            </div>
                        </div>
                    </div>
                </li>
                <li id="do-choi-cong-nghe">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/game.svg" class="filter-green" />
                        <span>Đồ chơi c&#244;ng nghệ</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g0">
                                <h4><a>Đồ chơi c&#244;ng nghệ</a></h4>
                                <ul class="display-row format_1">
                                    <li><a href="/category">Quạt để b&#224;n</a></li>
                                    <li><a href="/category">D&#226;y đo nhịp tim</a></li>
                                    <li><a href="/category">Tay cầm chống rung</a></li>
                                    <li><a href="/category">Camera h&#224;nh tr&#236;nh</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="kho-san-pham-cu">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/iphoneold.svg" class="filter-green" />
                        <span>M&#225;y tr&#244;i</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g0">
                                <h4><a>H&#224;ng cũ gi&#225; rẻ</a></h4>
                                <ul class="display-column format_3">
                                    <li><a href="/category">Điện thoại di động</a></li>
                                    <li><a href="/category">Đồng hồ th&#244;ng minh</a></li>
                                    <li><a href="/category">M&#225;y t&#237;nh bảng</a></li>
                                    <li><a href="/category">Laptop</a></li>
                                    <li><a href="/category">Loa</a></li>
                                    <li><a href="/category">Tai nghe</a></li>
                                    <li><a href="/category">Camera</a></li>
                                    <li><a href="/category">Củ sạc</a></li>
                                    <li><a href="/category">D&#226;y c&#225;p</a></li>
{{--                                    <li><a href="/kho-san-pham-cu?=&amp;filters={&quot;type&quot;:&quot;28&quot;}">M&#225;y lọc kh&#244;ng kh&#237;</a></li>--}}
{{--                                    <li><a href="/kho-san-pham-cu?=&amp;filters={&quot;type&quot;:&quot;18&quot;}">Phụ kiện</a></li>--}}
{{--                                    <li><a href="/kho-san-pham-cu?=&amp;filters={&quot;type&quot;:&quot;25&quot;}">Sạc dự ph&#242;ng</a></li>--}}
{{--                                    <li><a href="/kho-san-pham-cu?=&amp;filters={&quot;type&quot;:&quot;30&quot;}">Tay cầm chống rung</a></li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="dich-vu-sua-chua">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/fix.svg" class="filter-green" />
                        <span>Sửa chữa</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g0">
                                <h4><a href="/dich-vu-sua-chua/android">Android</a></h4>
                                <ul class="display-column format_2">
                                    <li><a href="/category">Pin</a></li>
                                    <li><a href="/category">Camera</a></li>
                                    <li><a href="/category">M&#224;n h&#236;nh</a></li>
                                    <li><a href="/category  ">Lỗi tr&#234;n main</a></li>
                                    <li><a href="/category">Vỏ v&#224; mặt lưng</a></li>
                                </ul>
                            </div>
                            <div class="menu g1">
                                <h4><a href="/category">Apple iPhone</a></h4>
                                <ul class="display-column format_2">
                                    <li><a href="/category">Vỏ k&#237;nh</a></li>
                                    <li><a href="/category">Camera</a></li>
                                    <li><a href="/category">C&#225;c loại c&#225;p</a></li>
                                    <li><a href="/dich-vu-sua-chua/apple/iphone/loi-tren-main">Lỗi tr&#234;n main</a></li>
                                </ul>
                            </div>
                            <div class="menu g2">
                                <h4><a href="/category">Apple iPad</a></h4>
                                <ul class="display-row format_3">
                                    <li><a href="/category">Pin</a></li>
                                    <li><a href="/category">Cảm ứng</a></li>
                                    <li><a href="/category">M&#224;n h&#236;nh</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="sim-the">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/simthe.svg" class="filter-green" />
                        <span>Sim thẻ</span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g1">
                                <h4><a>Sản phẩm HOT</a></h4>
                                <ul class="display-row format_5">
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="tin-tuc">
                    <a href="/" target="_self">
                        <img src="/assets/frontend/image/news.svg" class="filter-green" />
                        <span>Tin tức</span>
                    </a>
                </li>
                <li id="tin-khuyen-maiflashsale">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/flashsale.svg" class="filter-green" />
                        <span>Flash Sale </span>
                    </a>
                    <div class="sub-container">
                        <div class="sub">
                            <div class="menu g0">
                                <h4><a href="/category">Ưu đ&#227;i Hot</a></h4>
                                <ul class="display-row format_1">
                                    <li><a href="/category">Khuyến mại Apple</a></li>
                                    <li><a href="/category">Khuyến mại cuối tuần</a></li>
                                    <li><a href="/category">Khuyến mại đồng hồ</a></li>
                                    <li><a href="/category">Khuyến m&#227;i JBL, Harman Kardon</a></li>
                                    <li><a href="/category">Khuyến mại Laptop</a></li>
                                    <li><a href="/category">Khuyến mại LG</a></li>
{{--                                    <li><a href="/tin-khuyen-mai/flashsale/khuyen-mai-sony">Khuyến mại Sony</a></li>--}}
{{--                                    <li><a href="/tin-khuyen-mai/uu-dai-hot/le-hoi-mua-sam-xiaomi">Lễ hội mua sắm Xiaomi</a></li>--}}
{{--                                    <li><a href="/tin-khuyen-mai/san-pham-doc-quyen">Sản phẩm độc quyền</a></li>--}}
{{--                                    <li><a href="/tin-khuyen-mai/flashsale/khuyen-mai-tai-nghe">Top 5 tai nghe Bluetooth</a></li>--}}
{{--                                    <li><a href="/tin-khuyen-mai/khuyen-mai-samsung">Khuyến mại Samsung</a></li>--}}
                                </ul>
                            </div>
                            <div class="menu ads" style="width:20px">
                            </div>
                        </div>
                    </div>
                </li>
                <li id="khuyen-mai-hot">
                    <a href="/category" target="_self">
                        <img src="/assets/frontend/image/fire.svg" class="filter-green" />
                        <span>CT Khuyến mại</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- nav -->
</header>




