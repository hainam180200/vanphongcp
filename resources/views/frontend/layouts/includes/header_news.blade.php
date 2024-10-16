<div class="td-scroll-up"><i class="fas fa-chevron-up" style="position: absolute;left: 50%;color: white;   top:50%;transform: translate(-50%,-50%);"></i></div>

<div class="td-menu-background"></div>
<div id="td-mobile-nav">
    <div class="td-mobile-container">
        <!-- mobile menu top section -->
        <div class="td-menu-socials-wrap">
            <!-- socials -->
            <div class="td-menu-socials">

                {{--        <span class="td-social-icon-wrap">--}}
                {{--            <a target="_blank" href="/" title="Facebook">--}}
                {{--                <i class="td-icon-font td-icon-facebook"></i>--}}
                {{--            </a>--}}
                {{--        </span>    --}}
            </div>
            <!-- close button -->
            <div class="td-mobile-close">
                <a href="#"><i class="fas fa-times" style="color: white;padding: 8px 8px 0 0" ></i></a>
            </div>
        </div>

        <!-- login section -->
        <div class="td-menu-login-section">

            <div class="td-guest-wrap">
                <div class="td-menu-login"><a href="/login">Đăng nhập</a></div>
            </div>
        </div>

        <!-- menu section -->
        {!! widget('frontend.widget.blog._menu_mobile') !!}

    </div>

    <!-- register/login section -->
    <div id="login-form-mobile" class="td-register-section">
        <div id="td-login-mob" class="td-login-animation td-login-hide-mob">
            <!-- close button -->
            <div class="td-login-close">
                <a href="#" class="td-back-button"><i class="td-icon-read-down"></i></a>
                <div class="td-login-title">Đăng nhập</div>
                <!-- close button -->
                <div class="td-mobile-close">
                    <a href="#"><i class="fas fa-times" style="color: white;padding: 8px 8px 0 0"></i></a>
                </div>
            </div>
            <div class="td-login-form-wrap">
                <div class="td-login-panel-title"><span>Hoan nghênh!</span>đăng nhập vào tài khoản của bạn</div>
                <div class="td_display_err"></div>
                <div class="td-login-inputs"><input class="td-login-input" type="text" name="login_email" id="login_email-mob" value="" required><label>Tài khoản</label></div>
                <div class="td-login-inputs"><input class="td-login-input" type="password" name="login_pass" id="login_pass-mob" value="" required><label>mật khẩu của bạn</label></div>
                <input type="button" name="login_button" id="login_button-mob" class="td-login-button" value="Đăng nhập">
                <div class="td-login-info-text">
                    <a href="#" id="forgot-pass-link-mob">Quên mật khẩu?</a>
                </div>
                <div class="td-login-register-link">
                </div>
            </div>
        </div>
        <div id="td-forgot-pass-mob" class="td-login-animation td-login-hide-mob">
            <!-- close button -->
            <div class="td-forgot-pass-close">
                <a href="#" class="td-back-button"><i class="td-icon-read-down"></i></a>
                <div class="td-login-title">Khôi phục mật khẩu</div>
            </div>
            <div class="td-login-form-wrap">
                <div class="td-login-panel-title">Khởi tạo mật khẩu</div>
                <div class="td_display_err"></div>
                <div class="td-login-inputs"><input class="td-login-input" type="text" name="forgot_email" id="forgot_email-mob" value="" required><label>email của bạn</label></div>
                <input type="button" name="forgot_button" id="forgot_button-mob" class="td-login-button" value="Gửi Tôi Pass">
            </div>
        </div>
    </div>
</div>
<div class="td-search-background"></div>
<div class="td-search-wrap-mob">
    <div class="td-drop-down-search">
        <form method="get" action="/item-list" class="td-search-form">
            <!-- close button -->
            <div class="td-search-close">
                <a href="#"><i class="fas fa-times" style="color: white;padding: 8px 8px 0 0"></i></a>
            </div>
            <div role="search" class="td-search-input">
                <span>TÌM KIẾM</span>
                <input id="td-header-search-mob " class="searchNewsMobile" type="text"  value=""  name="news" autocomplete="off" />
            </div>
        </form>
{{--        <div id="td-aj-search-mob" class="td-ajax-search-flex">--}}
            <div class="td-aj-search-results news_results_mobile">
{{--                <div class="td_module_mx2 td_module_wrap td-animation-stack">--}}
{{--                    <div class="td-module-thumb">--}}
{{--                        <a href="" class="td-image-wrap" title="">--}}
{{--                            <img width="80" height="60" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/iu-80x60.jpg" srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/iu-80x60.jpg 80w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/iu-265x198.jpg 265w" sizes="(max-width: 80px) 100vw, 80px" alt="" title="Laptop HP Gaming Victus – Chiến game rực lửa cùng “trợ lý” uy tín!">--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="item-details">--}}
{{--                        <h3 class="entry-title td-module-title">--}}
{{--                            <a href="" title="">Laptop HP Gaming Victus – Chiến game rực lửa cùng “trợ lý” uy tín!</a>--}}
{{--                        </h3>--}}
{{--                        <div class="td-module-meta-info">--}}
{{--                            <a href="" class="td-post-category">Đánh giá</a>--}}
{{--                            <span class="td-post-date">--}}
{{--                                <time class="entry-date updated td-module-date" date-time="2022-03-30T10:59:47+00:00">--}}
{{--                                    30 Tháng Ba, 2022--}}
{{--                                </time>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
{{--        </div>--}}
    </div>
</div>
<div class="tdc-header-wrap ">
    <div class="td-header-wrap td-header-style-1 ">

        <div class="td-header-top-menu-full td-container-wrap ">
            <div class="td-container td-header-row td-header-top-menu">
                <!-- LOGIN MODAL -->
                <div  id="login-form" class="white-popup-block mfp-hide mfp-with-anim">
                    <div class="td-login-wrap">
                        <a href="#" class="td-back-button"><i class="td-icon-modal-back"></i></a>
                        <div id="td-login-div" class="td-login-form-div td-display-block">
                            <div class="td-login-panel-title">Đăng nhập</div>
                            <div class="td-login-panel-descr">Đăng nhập tài khoản</div>
                            <div class="td_display_err"></div>
                            <div class="td-login-inputs"><input class="td-login-input" type="text" name="login_email" id="login_email" value="" required><label>Tài khoản</label></div>
                            <div class="td-login-inputs"><input class="td-login-input" type="password" name="login_pass" id="login_pass" value="" required><label>mật khẩu của bạn</label></div>
                            <input type="button" name="login_button" id="login_button" class="wpb_button btn td-login-button" value="Login">
                            <div class="td-login-info-text"><a href="#" id="forgot-pass-link">Forgot your password? Get help</a></div>
                        </div>
                        <div id="td-forgot-pass-div" class="td-login-form-div td-display-none">
                            <div class="td-login-panel-title">Khôi phục mật khẩu</div>
                            <div class="td-login-panel-descr">Khởi tạo mật khẩu</div>
                            <div class="td_display_err"></div>
                            <div class="td-login-inputs"><input class="td-login-input" type="text" name="forgot_email" id="forgot_email" value="" required><label>email của bạn</label></div>
                            <input type="button" name="forgot_button" id="forgot_button" class="wpb_button btn td-login-button" value="Send My Password">
                            <div class="td-login-info-text">Mật khẩu đã được gửi vào email của bạn.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="td-banner-wrap-full td-logo-wrap-full td-container-wrap ">
            <div class="td-container td-header-row td-header-header">
                <div class="td-header-sp-logo">
                    <h1 class="td-logo">
                        <a class="td-main-logo" href="/">
                            <img src="{{\App\Library\Files::media(setting('sys_logo'))}}" alt="" title=""/>
                            <span class="td-visual-hidden">Tin tức công nghệ</span>
                        </a>
                    </h1>            </div>
                <div class="td-header-sp-recs">
                    <div class="td-header-rec-wrap">
                        <div class="td-a-rec td-a-rec-id-header  tdi_1_462 td_block_template_1">
                            <style>
                                /* custom css */
                                .tdi_1_462.td-a-rec-img{
                                    text-align: left;
                                }.tdi_1_462.td-a-rec-img img{
                                     margin: 0 auto 0 0;
                                 }
                            </style>
                            <div class="td-visible-desktop">
                                <a href="#"><img src="/tin-tuc/wp-content/uploads/2018/03/T3-TUYỂN-DỤNG-AD-TRANG-TIN.png" alt="" /></a>
                            </div>
                            <div class="td-visible-tablet-landscape">
                                <a href="#"><img src="/tin-tuc/wp-content/uploads/2018/03/T3-TUYỂN-DỤNG-AD-TRANG-TIN.png" alt="" /></a>
                            </div>
                            <div class="td-visible-tablet-portrait">
                                <a href="#"><img src="/tin-tuc/wp-content/uploads/2018/03/T3-TUYỂN-DỤNG-AD-TRANG-TIN.png" alt="" /></a>
                            </div>
                            <div class="td-visible-phone">
                                <a href="#"><img src="/tin-tuc/wp-content/uploads/2018/03/T3-TUYỂN-DỤNG-AD-TRANG-TIN.png" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="td-header-menu-wrap-full td-container-wrap ">
                <div class="td-header-menu-wrap td-header-gradient ">
                    <div class="td-container td-header-row td-header-main-menu">
                        <div id="td-header-menu" role="navigation">
                            <div id="td-top-mobile-toggle"><a href="#"><i class="fas fa-bars"></i></a></div>
                            <div class="td-main-menu-logo td-logo-in-header">
                                <a class="td-mobile-logo td-sticky-header" href="/">
                                    <img src="{{\App\Library\Files::media(setting('sys_logo'))}}" alt="" title=""/>
                                </a>
                                <a class="td-header-logo td-sticky-header" href="/">
                                    <img src="{{\App\Library\Files::media(setting('sys_logo'))}}" alt="" title=""/>
                                </a>
                            </div>

                            <div class="menu-mainmenu-container">
                                <ul id="menu-mainmenu-1" class="sf-menu">

{{--                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-first td-menu-item td-normal-menu menu-item-99541"><a href="/">Trang Chủ </a></li>--}}
                                    {!! widget('frontend.widget.blog._menu') !!}
{{--                                    <form  method="get" action="/item-list" class="td-search-form" >--}}
{{--                                        <div role="search" class="td-head-form-search-wrap">--}}
{{--                                            <input id="td-header-search" class="searchNews" type="text"     name="news" autocomplete="off" /><input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="TÌM KIẾM" />--}}
{{--                                        </div>--}}
{{--                                    </form>--}}



                                </ul>
                            </div>
                            <div class="header-search-wrap">
                                <div class="td-search-btns-wrap">
                                    <a id="td-header-search-button" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><i class="fas fa-search" style="color: white"></i></a>
                                    <a id="td-header-search-button-mob" href="#" class="dropdown-toggle " data-toggle="dropdown"><i class="fas fa-search" style="color: white"></i></a>
                                </div>

                                <div class="td-drop-down-search" aria-labelledby="td-header-search-button">
{{--                                    <form  method="get" action="/item-list" class="td-search-form" >--}}
{{--                                        <div role="search" class="td-head-form-search-wrap">--}}
{{--                                            <input id="td-header-search" class="searchNews" type="text"     name="news" autocomplete="off" /><input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="TÌM KIẾM" />--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
                                    <form  method="get" action="/item-list" class="td-search-form" >
                                        <div role="search" class="td-head-form-search-wrap">
                                            <input id="td-header-search" class="searchNews" type="text"     name="news" autocomplete="off" /><input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="TÌM KIẾM" />
                                        </div>
                                    </form>

                                    <div class="td-aj-search-results news_results">
{{--                                        <div class="td_module_mx2 td_module_wrap td-animation-stack">--}}
{{--                                            <div class="td-module-thumb">--}}
{{--                                                <a href="" class="td-image-wrap" title="">--}}
{{--                                                    <img width="80" height="60" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/iu-80x60.jpg" srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/iu-80x60.jpg 80w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/03/iu-265x198.jpg 265w" sizes="(max-width: 80px) 100vw, 80px" alt="" title="Laptop HP Gaming Victus – Chiến game rực lửa cùng “trợ lý” uy tín!">--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="item-details">--}}
{{--                                                <h3 class="entry-title td-module-title">--}}
{{--                                                    <a href="" title="">Laptop HP Gaming Victus – Chiến game rực lửa cùng “trợ lý” uy tín!</a>--}}
{{--                                                </h3>--}}
{{--                                                <div class="td-module-meta-info">--}}
{{--                                                    <a href="" class="td-post-category">Đánh giá</a>--}}
{{--                                                    <span class="td-post-date">--}}
{{--                                                        <time class="entry-date updated td-module-date" date-time="2022-03-30T10:59:47+00:00">--}}
{{--                                                            30 Tháng Ba, 2022--}}
{{--                                                        </time>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}



                                    </div>


{{--                                    <div id="td-aj-search"></div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>



</div>
