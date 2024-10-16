@extends('frontend.layouts.master')
@section('content')
<section>
    <div class="container">
        <div class="full-width-content">
            <div class="just-center">
                <p>Nhập địa chỉ email đăng ký để khởi tạo lại mật khẩu. </p>

            </div>
            <div class="just-center">
                <form method="post" action="/Account/ForgotPassword" class="js-validation-reminder form-horizontal push-30-t push-50">
                    <input name="__RequestVerificationToken" type="hidden" value="_1S5-EhcLi7UL0aroIDLdC2juhD1laKwKxc9BywuhmW6Du6iEvCtu9HIMvCHfYPdj8o3yZ5rgOuXw9tISF5aK86zwi81" />
                    <input class="form-control" type="Email" id="Email" name="Email" placeholder="Nhập địa chỉ email" /> <button class="btn btn-block btn-primary" type="submit"><i class="si si-envelope-open pull-right"></i> Gửi yêu cầu</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
