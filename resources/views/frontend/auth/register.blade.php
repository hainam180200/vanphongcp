
@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="login-form">
            <div class="login-bg">
                <img src="assets/frontend/image/login-bg.png" />
            </div>

            <div class="form">

                <div class="center" style="text-align:center;">
                    <h2>Đăng ký tài khoản</h2>
                    <p>Chú ý các nội dung có dấu * bạn cần phải nhập</p>
                    <p style="color: red"> <strong>{{ $errors->first() }}</strong></p>

                </div>

                <div id="registerForm" class="hh-form">
                    <form method="post" action="/register">
                        {{ csrf_field() }}
                        <div class="form-controls">
                            <label>Tài khoản:</label>
                            <div class="controls">
                                <input type="text" name="username" id="username" placeholder="Tài khoản *"/>
                            </div>
                        </div>
                        <div class="form-controls">
                            <label>Mật khẩu:</label>
                            <div class="controls">
                                <input type="password" name="password" id="password" placeholder="Mật khẩu *"/>
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Nhập lại mật khẩu:</label>
                            <div class="controls">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu *"/>
                            </div>
                        </div>



                        <div class="form-controls">
                            <label>Email:</label>
                            <div class="controls">
                                <input type="text" name="email" id="email" placeholder="Email *" />
                            </div>
                        </div>
                        <div class="form-controls">
                            <label>Số điện thoại:</label>
                            <div class="controls">
                                <input type="text" name="phone" id="phone" placeholder="Số điện thoại *" />
                            </div>
                        </div>

                        <div class="form-controls">
                            <label>Giới tính:</label>
                            <div class="controls">
                                <label class="radio-ctn">
                                    <input type="radio" name="gender" value="1" >
                                    <span class="checkmark"></span>
                                    <span><strong>Nam</strong></span>
                                </label>

                                <label class="radio-ctn">
                                    <input type="radio" name="gender" value="0" >
                                    <span class="checkmark"></span>
                                    <span><strong>Nữ</strong></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-controls">
                            <div class="controls submit-controls">
                                <button type="submit">ĐĂNG KÝ TÀI KHOẢN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
