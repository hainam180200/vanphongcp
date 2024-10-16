
@extends('frontend.layouts.master')
@section('content')
    <div class="container">

        <div class="login-form">
            <div class="login-bg">
                <img src="https://hoanghamobile.com/Content/web/img/login-bg.png" />
            </div>

            <div class="form">

                <div class="center" style="text-align:center;">
                    <h2>Đăng ký tài khoản</h2>
                    <p>Chú ý các nội dung có dấu * bạn cần phải nhập</p>

                </div>

                <div id="registerForm" class="hh-form">
                    <form method="post" action="/Account/Register">
                        <input type="hidden" name="ReturnUrl" />
                        <input name="__RequestVerificationToken" type="hidden" value="O7O88IZKShB6de83inGL3PMlGdAkBO6QKVvp1I6qHahDQJi8gFgozNatiaSe9TIN7qRWYuh5FWNOYvQZN6qXIVKzrhE1" />

                        <div class="form-controls">
                            <label>Tài khoản:</label>
                            <div class="controls">
                                <input type="text" name="UserName" id="UserName" placeholder="Tài khoản *" data-required="1" />
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Họ tên:</label>
                            <div class="controls">
                                <input type="text" name="Title" id="Title" placeholder="Họ tên *" data-required="1" />
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Mật khẩu:</label>
                            <div class="controls">
                                <input type="text" name="PasswordHash" id="PasswordHash" placeholder="Mật khẩu *" data-required="1" />
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Nhập lại mật khẩu:</label>
                            <div class="controls">
                                <input type="text" name="SecurityStamp" id="SecurityStamp" placeholder="Nhập lại mật khẩu *" data-required="1" />
                            </div>
                        </div>



                        <div class="form-controls">
                            <label>Email:</label>
                            <div class="controls">
                                <input type="text" name="Email" id="Email" placeholder="Email *" data-required="1" />
                            </div>
                        </div>

                        <div class="form-controls">
                            <label>Giới tính:</label>
                            <div class="controls">
                                <label class="radio-ctn">
                                    <input type="radio" name="Sex" value="true" >
                                    <span class="checkmark"></span>
                                    <span><strong>Nam</strong></span>
                                </label>

                                <label class="radio-ctn">
                                    <input type="radio" name="Sex" value="false" >
                                    <span class="checkmark"></span>
                                    <span><strong>Nữ</strong></span>
                                </label>
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Ngày tháng năm sinh:</label>
                            <div class="controls">
                                <input type="text" value="" name="UserBirthDate" id="UserBirthDate" placeholder="Ngày tháng năm sinh" />
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Điện thoại:</label>
                            <div class="controls">
                                <input type="tel" name="PhoneNumber" id="PhoneNumber" placeholder="Điện thoại *" data-required="1" />
                            </div>
                        </div>

                        <div class="form-controls">
                            <label>Địa chỉ:</label>
                            <div class="controls">
                                <input type="text" name="Address" id="Address" placeholder="Địa chỉ *" data-required="1" />
                            </div>
                        </div>

                        <div class="form-controls">
                            <label>Tỉnh/Thành phố:</label>
                            <div class="controls">
                                <select name="SystemCityID" id="SystemCityID" placeholder="Tỉnh/Thành phố">
                                    <option value="">Chọn tỉnh/thành phố</option>
                                    <option value="1" >H&#224; Nội</option>
                                    <option value="50" >TP HCM</option>
                                    <option value="57" >An Giang</option>
                                    <option value="49" >B&#224; Rịa</option>
                                    <option value="15" >Bắc Giang</option>
                                    <option value="4" >Bắc Kạn</option>
                                    <option value="62" >Bạc Li&#234;u</option>
                                    <option value="18" >Bắc Ninh</option>
                                    <option value="53" >Bến Tre</option>
                                    <option value="35" >B&#236;nh Định</option>
                                    <option value="47" >B&#236;nh Dương</option>
                                    <option value="45" >B&#236;nh Phước</option>
                                    <option value="39" >B&#236;nh Thuận</option>
                                    <option value="63" >C&#224; Mau</option>
                                    <option value="59" >Cần Thơ</option>
                                    <option value="3" >Cao Bằng</option>
                                    <option value="32" >Đ&#224; Nẵng</option>
                                    <option value="42" >Đắk Lắk</option>
                                    <option value="43" >Đắk N&#244;ng</option>
                                    <option value="7" >Điện Bi&#234;n</option>
                                    <option value="48" >Đồng Nai</option>
                                    <option value="56" >Đồng Th&#225;p</option>
                                    <option value="41" >Gia Lai</option>
                                    <option value="2" >H&#224; Giang</option>
                                    <option value="23" >H&#224; Nam</option>
                                    <option value="28" >H&#224; Tĩnh</option>
                                    <option value="19" >Hải Dương</option>
                                    <option value="20" >Hải Ph&#242;ng</option>
                                    <option value="60" >Hậu Giang</option>
                                    <option value="11" >Ho&#224; B&#236;nh</option>
                                    <option value="21" >Hưng Y&#234;n</option>
                                    <option value="37" >Kh&#225;nh H&#242;a</option>
                                    <option value="58" >Ki&#234;n Giang</option>
                                    <option value="40" >Kon Tum</option>
                                    <option value="8" >Lai Ch&#226;u</option>
                                    <option value="44" >L&#226;m Đồng</option>
                                    <option value="13" >Lạng Sơn</option>
                                    <option value="6" >L&#224;o Cai</option>
                                    <option value="51" >Long An</option>
                                    <option value="24" >Nam Định</option>
                                    <option value="27" >Nghệ An</option>
                                    <option value="25" >Ninh B&#236;nh</option>
                                    <option value="38" >Ninh Thuận</option>
                                    <option value="16" >Ph&#250; Thọ</option>
                                    <option value="36" >Ph&#250; Y&#234;n</option>
                                    <option value="29" >Quảng B&#236;nh</option>
                                    <option value="33" >Quảng Nam</option>
                                    <option value="34" >Quảng Ng&#227;i</option>
                                    <option value="14" >Quảng Ninh</option>
                                    <option value="30" >Quảng Trị</option>
                                    <option value="61" >S&#243;c Trăng</option>
                                    <option value="9" >Sơn La</option>
                                    <option value="46" >T&#226;y Ninh</option>
                                    <option value="22" >Th&#225;i B&#236;nh</option>
                                    <option value="12" >Th&#225;i Nguy&#234;n</option>
                                    <option value="26" >Thanh H&#243;a</option>
                                    <option value="31" >Thừa Thi&#234;n Huế</option>
                                    <option value="52" >Tiền Giang</option>
                                    <option value="54" >Tr&#224; Vinh</option>
                                    <option value="5" >Tuy&#234;n Quang</option>
                                    <option value="55" >Vĩnh Long</option>
                                    <option value="17" >Vĩnh Ph&#250;c</option>
                                    <option value="10" >Y&#234;n B&#225;i</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-controls">
                            <label>Quận/Huyện:</label>
                            <div class="controls">
                                <select id="SystemDistrictID" name="SystemDistrictID" placeholder="Quận/Huyện *" data-required="1">
                                    <option value="">Chọn quận/Huyện *</option>
                                </select>
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
