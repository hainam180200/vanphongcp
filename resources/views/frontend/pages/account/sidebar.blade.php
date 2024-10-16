<div class="sidebar">
    <div class="ctn">
        <div class="header">
            <div class="logo">
                <a href="/">   <img src="{{\App\Library\Files::media(setting('sys_logo'))}}"></a>
            </div>

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
                    <p><strong>{{ isset(Auth::guard('frontend')->user()->username)?\Str::limit( Auth::guard('frontend')->user()->username,8) : null }}</strong></p>

                    <input type="file" name="cover_mobile" id="cover_mobile" accept="image/*" hidden />
                    {{--                            <input type="file" id="imageCover" accept="image/*" hidden>--}}
                    <label for="cover_mobile"  style="cursor: pointer">
                        <p class="change-avatar"><i class="icon-change-avatar"></i> Thay đổi ảnh đại diện</p>

                    </label>
                </div>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="/account/index" class="activeindex"  ><i class="fas fa-sliders-h"></i><span>Bảng điều khiển</span></a></li>
                <li><a href="/account/info" class="activeinfo"><i class="fas fa-user-circle" ></i><span>Thông tin tài khoản</span></a></li>
                <li><a href="/account/order"  class="activeorder"><i class="fas fa-box-open" ></i><span>Đơn hàng của bạn</span></a></li>
                <li><a href="/account/wishlist" class="activefavorite"><i class="fas fa-heart"></i><span>Sản phẩm yêu thích</span></a></li>
{{--                <li><a href="/account/comment" @if(Request::is('/account/comment')) class="active" @endif><i class="fas fa-comments"></i><span>Quản lý bình luận</span></a></li>--}}
{{--                <li><a href="/account/review"><i class="fas fa-edit"></i><span>Quản lý đánh giá</span></a></li>--}}
                <li><a href="/logout"><i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span></a></li>
            </ul>
        </nav>

        <div class="hotline">
            <div>
                <strong>Bạn cần hỗ trợ?</strong>
                <a href="tel:{{setting('sys_phone')}}"><i class="icon-calling"></i> <strong>{{setting('sys_phone')}}</strong></a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(document).on('change', '#cover_mobile', function(){

            var name = document.getElementById("cover_mobile").files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("cover_mobile").files[0]);

            form_data.append("cover_mobile", document.getElementById('cover_mobile').files[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                url:"/postimageProfile",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    // $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                },
                success:function(data)
                {
                    $(".idol_detail_content_intro_bg .idol_detail_content_intro_bg_in").html(``)
                }
            }).done(function(data) {
                location.reload();
            });
            // }
        });
    });

</script>
