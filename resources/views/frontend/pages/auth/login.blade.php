
@extends('frontend.layouts.master')
@section('content')
<div class="container">
    <div class="login-form">
        <div class="login-bg">
            <img src="./assets/frontend/image/login-bg.png" />
        </div>
        <div class="form">
            <h1>Đăng nhập</h1>

            <div class="external">
                <form style="text-align: center">
                    <a href="https://facebook.muabandienthoai24h.vn/facebook/{{\Request::getHost()}}" style="margin: auto"><button class="btn-extlogin btn-facebook" title="Đăng nhập qua Facebook" type="button" name="provider"><img src="./assets/frontend/image/login-facebook.png" /> Tiếp tục với Facebook</button></a>
                    <a href="" style="margin: auto"> <button class="btn-extlogin btn-google" type="submit" title="Đăng nhập qua Google+" id="Google" name="provider" value="Google"><img src="./assets/frontend/image/login-google.png" /> Đăng nhập với Google</button></a>
                </form>
            </div>

            <div class="split">
                <p>Hoặc</p>
            </div>

            <div class="internal">
                <form action="/login" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-2 text-center" style="padding-bottom: 6px">
                        <span class="help-block text-danger notify-error" style="font-size: .8rem;color: red" >
                                                       <strong>{{ $errors->first() }}</strong>
                                                </span>
                    </div>
                    <div class="row">
                        <div class="label">Tài khoản</div>
                        <div class="input">
                            <input type="text" name="username" id="username" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="label">Mật khẩu</div>
                        <div class="input">
                            <input type="password" name="password" id="password" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="row">
                        <label class="checkbox-ctn">Nhớ đăng nhập
                            <input type="checkbox" name="remember" value="true">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="row">
                        <div class="button-group">
                            <button class="btn btn-submit" type="submit" name="usernametemp">ĐĂNG NHẬP</button>
                            <a class="btn btn-link " href="/register">ĐĂNG KÝ</a>
                        </div>
                    </div>

                    <div class="row">
                        <p class="forgotpass"><a class="" href="/Account/ForgotPassword">Quên mật khẩu?</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
