@extends('frontend.layouts.master')
@section('content')
    <section class="account">

        @include('frontend.pages.account.sidebar')
        <div class="body-content">



            <h1>Th&#244;ng tin t&#224;i khoản</h1>
            <p style="color: red;font-size: 14px">    {{ $errors->first() }}</p>
            <div class="header">
                <div class="bg">
                    <div class="text">
                        <h2>CHÀO MỪNG QUAY TRỞ LẠI, {{ isset($user)? $user->username : "" }}</h2>
                        <p><i>Kiểm tra và chỉnh sửa thông tin cá nhân của bạn tại đây</i></p>
                    </div>
                </div>
                <div class="icon">
                    <img src="/assets/frontend/image/account_2.png" />
                </div>
            </div>

            <div class="account-layout ">
                <div class="row equaHeight" data-obj=".col .box-bg-white">
                    <div class="col col-lg">
                        <h3>Cập nhật thông tin cá nhân</h3>
                        <div class="box-bg-white">
                            <div class="account-form">
                                <form action="/profile" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-controls">
                                        <label>Họ tên:</label>
                                        <div class="controls">
                                            <input type="text" value="{{ isset($user)? $user->username : "" }}" name="username"  id="Title" placeholder="Họ tên *" data-required="1" />
                                        </div>
                                    </div>

                                    <div class="form-controls">
                                        <label>Giới tính:</label>
                                        <div class="controls">
                                            <input type="radio" id="men" name="man" hidden>
                                            <label class="radio-ctn" for="men">
                                                <input checked type="radio" name="Sex" value="true">
                                                <span class="checkmark"></span>
                                                <span><strong>Nam</strong></span>
                                            </label>
                                            <input type="radio" id="woman" name="men" hidden>
                                            <label class="radio-ctn" for="woman" >
                                                <input  type="radio" name="Sex" value="false">
                                                <span class="checkmark"></span>
                                                <span><strong>Nữ</strong></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-controls">
                                        <label>Điện thoại:</label>
                                        <div class="controls">
                                            <input type="tel" value="{{ isset($user)? $user->phone : "" }}" name="phone" id="PhoneNumber" placeholder="Điện thoại *" data-required="1" />
                                        </div>
                                    </div>

                                    <div class="form-controls">
                                        <label>Email:</label>
                                        <div class="controls">
                                            <input type="text" value="{{ isset($user)? $user->email : "" }}" name="" id="Email" placeholder="Email *" data-required="1" disabled/>
                                        </div>
                                    </div>

                                    <div class="form-controls">
                                        <label>Địa chỉ:</label>
                                        <div class="controls">
                                            <input type="text" value="{{ isset($user)? $user->address : "" }}" name="address" id="Address" placeholder="Địa chỉ *" data-required="1" />
                                        </div>
                                    </div>

                                    <div class="form-controls">
                                        <label>Tỉnh/Thành phố:</label>
                                        <div class="controls">
                                            <select name="provinces" id="provinces" placeholder="Tỉnh/Thành phố">
                                                @if (isset($dataDistrict) && count($dataDistrict) > 0)
                                                    @foreach ($dataDistrict as $item)
                                                        <option value="{{$item->code}}">{{$item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <p></p>

{{--                                    <div class="form-controls">--}}
{{--                                        <label>Quận/Huyện:</label>--}}
{{--                                        <div class="controls">--}}
{{--                                            <select id="SystemDistrictID" name="SystemDistrictID" placeholder="Quận/Huyện *" data-required="1">--}}
{{--                                                <option value="">Chọn quận/Huyện *</option>--}}
{{--                                                <option value="16">Hai Bà Trưng</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


                                    <div class="form-controls">
                                        <label>Ngày tháng năm sinh:</label>
                                        <div class="controls">
                                            <input type="date" value="{{ isset($user)? $user->birtday : "" }}" name="birtday" id="UserBirthDate" placeholder="Ngày tháng năm sinh" />
                                        </div>
                                    </div>

                                    <div class="form-controls">
                                        <label>Tên công ty:</label>
                                        <div class="controls">
                                            <input type="text" name="CompanyName" id="CompanyTitle" value="{{ isset($user_meta['CompanyName'])? $user_meta['CompanyName'] : '' }}" placeholder="Tên công ty"  />
                                        </div>
                                    </div>

                                    <div class="form-controls">
                                        <label>Địa chỉ công ty:</label>
                                        <div class="controls">
                                            <input type="text" name="CompanyAddress" value="{{ isset($user_meta['CompanyAddress'])? $user_meta['CompanyAddress'] : '' }}" id="CompanyAddress" placeholder="Địa chỉ công ty"  />
                                        </div>
                                    </div>

                                    <div class="form-controls">
                                        <label>Mã số thuế công ty:</label>
                                        <div class="controls">
                                            <input type="text" name="CompanyID" value="{{ isset($user_meta['CompanyID'])? $user_meta['CompanyID'] : '' }}" id="CompanyID" placeholder="Mã số thuế công ty"  />
                                        </div>
                                    </div>

                                    <div class="form-controls">
                                        <div class="controls submit-controls">
                                            <p style="text-align:center;">Để trống nếu không muốn thay đổi mật khẩu.</p>
                                        </div>
                                    </div>


                                    <div class="form-controls">
                                        <label>Mật khẩu mới: </label>
                                        <div class="controls">
                                            <input type="password" value="" name="password" id="password" placeholder="Mật khẩu mới" />
                                        </div>
                                    </div>

                                    <div class="form-controls">
                                        <label>Nhập lại mật khẩu mới: </label>
                                        <div class="controls">
                                            <input type="text" name="password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu mới" />
                                        </div>
                                    </div>



                                    <div class="form-controls">
                                        <div class="controls submit-controls">
                                            <button type="submit">XÁC NHẬN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col col-sm">
                        <h3>Tư cách hiển thị</h3>
                        <div class="box-bg-white">
                            <div class="user-sticker">
                                <div class="info">
                                    @if(isset(Auth::guard('frontend')->user()->image))
                                        <div class="avt" id="myAvatar">
                                            <img src="{{ isset(Auth::guard('frontend')->user()->image)?\App\Library\Files::media(Auth::guard('frontend')->user()->image): null }}" />
                                        </div>
                                    @else
                                        <div class="avt" id="myAvatar">
                                            <i class="fas fa-user" style="font-size: 20px;margin-top: 20px;"></i>
                                        </div>
                                    @endif
                                    <div class="summer">
                                        <p><strong>{{ isset(Auth::guard('frontend')->user()->username)?Auth::guard('frontend')->user()->username: null }}</strong></p>
{{--                                        <p class="role"><i class="icon-star"></i> Thành viên hạng: <strong>0</strong></p>--}}
                                    </div>
                                </div>

                                <div class="user-acc-links">
                                    <h3>Các tài khoản liên kết</h3>
                                    <p>Bạn có thể đăng nhập qua Google, Facebook nhanh vào website. Để đăng nhập được bạn cần liên kết các tài khoản mạng xã hội với tài khoản của website.</p>
                                    <div class="acc">
                                        <form method="post" action="/Account/LinkLogin">
                                            <input name="__RequestVerificationToken" type="hidden" value="cTucOR_6R0IJLwCSFxNFIdWOQAeKwR3-pZwyAgmbW0H-PxNO8NKXIOxUOzB_nV5YoM7CG_dJ3fUbBGT1bHy_DMJE0fQvRjdL6Ptk4Gb50U6-VclQu7sDqusBArDVSd9Mg9wfUA2" />
                                            <input type="hidden" name="ReturnUrl" value="/account/info" />
                                            <p>
                                                <img src="https://hoanghamobile.com/Content/web/img/login-facebook.png" />
                                                <strong>Chưa liên kết</strong>
                                            </p>
                                            <button class="btn-extlogin btn-facebook" title="Liên kết tài khoản Facebook" type="submit" id="Facebook" name="provider" value="Facebook">
                                                <i class="icon-account"></i> Liên kết tài khoản Facebook
                                            </button>
                                        </form>
                                    </div>
                                    <div class="acc">

                                        <form method="post" action="/Account/LinkLogin">
                                            <input name="__RequestVerificationToken" type="hidden" value="T-XIOrIVXamtDnyWxplz-LXawcpm2uXRsCcVcIC-I0meuf1-hMw_Ieet3Y65kVPlmPhHMyTj6h-L-hsrNF-WkqMLMThwqwRhtxuNTN9vLPGlKoEAX-IgQPA21-MNoxlerZNpsw2" />
                                            <input type="hidden" name="ReturnUrl" value="/account/info" />
                                            <p>
                                                <img src="https://hoanghamobile.com/Content/web/img/login-google.png" />
                                                <span>Chưa liên kết</span>
                                            </p>
                                            <button class="btn-extlogin btn-google" type="submit" title="Đăng nhập qua Google+" id="Google" name="provider" value="Google">
                                                <i class="icon-account"></i> Liên kết tài khoản Google
                                            </button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('.activeinfo').addClass('active')
        })
    </script>
@endsection


