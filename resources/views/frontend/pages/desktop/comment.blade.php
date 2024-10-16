<section class="product-review product-comment" id="comments">
    <div class="container">
        <div class="full-width-content">
            <form action="/postComment" method="post">
                @csrf
                            <input name="__RequestVerificationToken" type="hidden" value="" />
                <input type="hidden" name="user_id" value="@if(Auth::guard('frontend')->check()){{Auth::guard('frontend')->user()->id}}@endif" />
                <input type="hidden" name="product_id" value="{{$data->id}}" />
                <div class="heading">
                    <h3>Bình luận về {{$data->title}}</h3>
                </div>
                <div class="rc-form review-form">
                    <div class="rc-form comment-form">
                        <div class="row">
                            <div class="col">
                                <div class="control">
                                    <textarea title="Nội dung" placeholder="Nội dung. Tối thiểu 15 ký tự *" class="user_comment" name="comment" spellcheck="false" data-required="1" data-minlength="15"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!auth()->guard('frontend')->check())
                                <div class="col">
                                    <p class="note">Để gửi bình luận, bạn cần đăng nhập</p>
                                </div>
                            @endif

                            <div class="col col-end">
                                @if(Auth::guard('frontend')->check())
                                    <button type="submit" id="btn-comment"><i class="fas fa-paper-plane"></i> Gửi bình luận</button>
                                @else
                                    <a href="/login"><button type="" id=""><i class="fas fa-paper-plane"></i> Gửi bình luận</button></a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="review-content comment-content" id="commentContent">

                @if(isset($comment) && count($comment) >0)

                    @foreach($comment as $keys=>$key)
                        @if($key->comment_parent==0)
                        <div class="item">
                            <div class="avt">
                                @if(isset($key->user->image) && $key->user->image !="")
                                        <img src="{{\App\Library\MediaHelpers::media($key->user->image) }}" alt=" ">
                                @else
                                    <img src="https://hoanghamobile.com/Content/web/img/no-avt.png" alt="">
                                @endif
                            </div>
                            <div class="info">

                                <p><strong>{{$key->user->username}}</strong></p>
                                <p><label><i>{{$key->created_at}}</i></label></p>
                                <div class="content">
                                  {{$key->content}}
                                </div>
                                <div class="childs">

                                    <div class="childs_items_reply_{{$key->id}}">
                                        @foreach ($comment as $key_child => $child_item)
                                            @if($key->id == $child_item->comment_parent)
                                                <div class="item">
                                                    <div class="avt">
                                                        @if(isset($child_item->user->image) && $child_item->user->image !="")

                                                                <img src="{{\App\Library\MediaHelpers::media($child_item->user->image) }}" alt=" ">

                                                        @else
                                                            <img src="https://hoanghamobile.com/Content/web/img/no-avt.png" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="info">
                                                        <p>
                                                            <strong>{{$child_item->user->username}}</strong>
                                                        </p>
                                                        <p><label><i>{{$child_item->created_at}}</i></label></p>
                                                        <div class="content">
                                                            {{$child_item->content}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>


                                    <div class="form-container">
                                        <form action="/postReplyComment" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="@if(Auth::guard('frontend')->check()){{Auth::guard('frontend')->user()->id}}@endif" />
                                            <input type="hidden" name="product_id" value="{{$data->id}}" />
                                            <input type="hidden" name="parent_id" value="{{$key->id}}" />
                                            <div class="rc-form comment-form">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="control">
                                                            <textarea name="reply_comment" class="reply_comment" id="" data-required="1" data-minlength="15" placeholder="Nội dung. Tối thiểu 15 ký tự *"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if(!auth()->guard('frontend')->check())
                                                        <div class="col">
                                                            <p class="note">Để gửi bình luận, bạn cần đăng nhập</p>
                                                        </div>
                                                    @endif
                                                    <div class="col col-end">
                                                        <button type="submit" id="btn-reply-comment">
                                                            <i class="fas fa-paper-plane "></i> Gửi bình luận
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    $(document).on('click','#btn-comment',function (e) {
        e.preventDefault();
        var formSubmit = $(this).closest('form');
        var url = formSubmit.attr('action')
        var formData = new FormData(formSubmit[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: url,
            data: formData, // serializes the form's elements.
            processData: false,
            contentType: false,
            datatype: "json",
            beforeSend: function (xhr) {
                // alert(url);
            },
            success: function (data) {
                $('#btn-comment').prop('disabled', true);
                let html='';
                html+='<div class="item">';


                if(data.data.author_img !=null){
                    html +='<div class="avt"> <img src="https://demo.muasammoingay.net/storage'+data.data.author_img+'" alt=""></div>'

                }else{
                    html +='<div class="avt"> <img src="https://hoanghamobile.com/Content/web/img/no-avt.png" alt=""></div>'
                }
                html +=' <div class="info">'
                html +='<p><strong>'+data.data.author_name+' </strong></p>';
                html+='<div class="content">'+data.data.content+'</div>';
                html+=' <div class="childs">';
                html+=' <div class="childs_items_reply_'+data.data.comment_parent+'" >';
                html+='</div>';
                html+=' <div class="form-container">';
                html+='<form action="/postReplyComment" method="POST">';
                html+= '@csrf';
                html+= ' <input type="hidden" name="user_id" value="'+data.data.author_id+'" />';
                html+= ' <input type="hidden" name="product_id" value="'+data.data.item_id+'" />';
                html+= ' <input type="hidden" name="parent_id" value="'+data.data.comment_parent+'" />';

                html+=' <div class="rc-form comment-form">';
                html+='<div class="row">';
                html+='  <div class="col">';
                html+=' <div class="control">';
                html+=' <textarea name="reply_comment" id="" data-required="1" data-minlength="15" class="reply_comment"  placeholder="Nội dung. Tối thiểu 15 ký tự *"></textarea>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+=' <div class="row">';
                // html+=' <div class="col">';
                // html+=' <p class="note">Để gửi bình luận, bạn cần đăng nhập</p>';
                // html+='</div>';
                html+='<div class="col col-end">';
                html+='<button type="submit" id="btn-reply-comment"><i class="fas fa-paper-plane "></i> Gửi bình luận</button>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='</form>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                html+='</div>';
                $(".user_comment").val("");
                $('#commentContent ').prepend(html);

            },
            error: function (data) {
                alert('{{('Cập nhật tải lêns thất bại.Vui lòng thử lại')}}', 'error');
            },
            complete: function (data) {
                $('#btn-comment').prop('disabled', false);
            }
        });
    })

    $(document).on('click','#btn-reply-comment',function (e) {
        e.preventDefault();
        var formSubmit = $(this).closest('form');
        var url = formSubmit.attr('action')
        var formData = new FormData(formSubmit[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: url,
            data: formData, // serializes the form's elements.
            processData: false,
            contentType: false,
            datatype: "json",
            beforeSend: function (xhr) {
                // alert(url);
            },
            success: function (data) {
                $('#btn-reply-comment').prop('disabled', true);
                console.log(data)
                let html='';
                html+='<div class="item">';
                if(data.data.author_img !=null){
                    html +='<div class="avt"> <img src="https://demo.muasammoingay.net/storage'+data.data.author_img+'" alt=""></div>'

                }else{
                    html +='<div class="avt"> <img src="https://hoanghamobile.com/Content/web/img/no-avt.png" alt=""></div>'
                }

                html +=' <div class="info">'
                html +='<p><strong>'+data.data.author_name+' </strong></p>';
                html+='<div class="content">'+data.data.content+'</div>';
                $(".reply_comment").val("");
                $('.childs_items_reply_'+data.data.comment_parent).append(html);

            },
            error: function (data) {
                alert('{{('Cập nhật tải lêns thất bại.Vui lòng thử lại')}}', 'error');
            },
            complete: function (data) {
                $('#btn-reply-comment').prop('disabled', false);
            }
        });
    })

</script>
{{--<div class="item">--}}
{{--    <div class="avt">--}}
{{--        <img src="https://hoanghamobile.com/Content/web/img/no-avt.png" alt="">--}}
{{--    </div>--}}
{{--    <div class="info">--}}
{{--        <p><strong>Hải Nam</strong></p>--}}
{{--        <p><label><i>6 ngày trước</i></label></p>--}}
{{--        <div class="content">--}}
{{--            Shop ơi laptop này còn không ạ--}}
{{--            <br>--}}
{{--        </div>--}}
{{--        <div class="childs">--}}
{{--            <div class="comment-list">--}}
{{--                <div class="item">--}}
{{--                    <div class="avt">--}}
{{--                        <img src="https://hoanghamobile.com/avatar/Uploads/Avatar/38427-hoaiphanks35-gmail-com-637702346314663932.jpeg" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="info">--}}
{{--                        <p>--}}
{{--                            <strong>Phạm Thu Hoài</strong>--}}
{{--                            <i class="fas fa-check icon-checked"></i>--}}
{{--                            <span>QTV mua bán điện thoại</span>--}}
{{--                        </p>--}}
{{--                        <p><label><i>6 ngày trước</i></label></p>--}}
{{--                        <div class="content">--}}
{{--                            Chào anh chị--}}
{{--                            <br>--}}
{{--                            Dạ hiện sản phẩm đang còn hàng tại chi nhánh:--}}
{{--                            <br>--}}
{{--                            Số 2 Nguyễn Văn Cừ, TP Bắc Giang--}}
{{--                            <br>--}}
{{--                            Anh/chị vui lòng liên hệ số Hotline19002091 để đảm bảo tình trạng còn hàng cũng như được tư vấn thêm về sản phẩm trước khi qua mua hàng Anh/chị nhé.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="replyHolder ">--}}
{{--                <input type="text" placeholder="Nhập bình luận của bạn">--}}
{{--                <button><i class="fas fa-paper-plane"></i></button>--}}
{{--            </div>--}}
{{--            <div class="form-container">--}}
{{--                <form action="">--}}
{{--                    <div class="rc-form comment-form">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <div class="control">--}}
{{--                                    <textarea name="" id="" data-required="1" data-minlength="15" placeholder="Nội dung. Tối thiểu 15 ký tự *"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <p class="note">Để gửi bình luận, bạn cần nhập tối thiểu trường họ tên và nội dung</p>--}}
{{--                            </div>--}}
{{--                            <div class="col col-end">--}}
{{--                                <button type="submit">--}}
{{--                                    <i class="fas fa-paper-plane "></i> Gửi bình luận--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--    <div class="avt">--}}
{{--        <img src="https://hoanghamobile.com/Content/web/img/no-avt.png" alt="">--}}
{{--    </div>--}}
{{--    <div class="info">--}}
{{--        <p><strong>Hải Nam</strong></p>--}}
{{--        <p><label><i>6 ngày trước</i></label></p>--}}
{{--        <div class="content">--}}
{{--            Shop ơi laptop này còn không ạ--}}
{{--            <br>--}}
{{--        </div>--}}
{{--        <div class="childs">--}}
{{--            <div class="comment-list">--}}
{{--                <div class="item">--}}
{{--                    <div class="avt">--}}
{{--                        <img src="https://hoanghamobile.com/avatar/Uploads/Avatar/38427-hoaiphanks35-gmail-com-637702346314663932.jpeg" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="info">--}}
{{--                        <p>--}}
{{--                            <strong>Phạm Thu Hoài</strong>--}}
{{--                            <i class="fas fa-check icon-checked"></i>--}}
{{--                            <span>QTV mua bán điện thoại</span>--}}
{{--                        </p>--}}
{{--                        <p><label><i>6 ngày trước</i></label></p>--}}
{{--                        <div class="content">--}}
{{--                            Chào anh chị--}}
{{--                            <br>--}}
{{--                            Dạ hiện sản phẩm đang còn hàng tại chi nhánh:--}}
{{--                            <br>--}}
{{--                            Số 2 Nguyễn Văn Cừ, TP Bắc Giang--}}
{{--                            <br>--}}
{{--                            Anh/chị vui lòng liên hệ số Hotline19002091 để đảm bảo tình trạng còn hàng cũng như được tư vấn thêm về sản phẩm trước khi qua mua hàng Anh/chị nhé.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="replyHolder replyCommentHolder">--}}
{{--                <input type="text" placeholder="Nhập bình luận của bạn">--}}
{{--                <button><i class="fas fa-paper-plane"></i></button>--}}
{{--            </div>--}}
{{--            <div class="form-container">--}}
{{--                <form action="">--}}
{{--                    <div class="rc-form comment-form">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <div class="control">--}}
{{--                                    <textarea name="" id="" data-required="1" data-minlength="15" placeholder="Nội dung. Tối thiểu 15 ký tự *"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <p class="note">Để gửi bình luận, bạn cần nhập tối thiểu trường họ tên và nội dung</p>--}}
{{--                            </div>--}}
{{--                            <div class="col col-end">--}}
{{--                                <button type="submit">--}}
{{--                                    <i class="fas fa-paper-plane "></i> Gửi bình luận--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--    <div class="avt">--}}
{{--        <img src="https://hoanghamobile.com/Content/web/img/no-avt.png" alt="">--}}
{{--    </div>--}}
{{--    <div class="info">--}}
{{--        <p><strong>Hải Nam</strong></p>--}}
{{--        <p><label><i>6 ngày trước</i></label></p>--}}
{{--        <div class="content">--}}
{{--            Shop ơi laptop này còn không ạ--}}
{{--            <br>--}}
{{--        </div>--}}
{{--        <div class="childs">--}}
{{--            <div class="comment-list">--}}
{{--                <div class="item">--}}
{{--                    <div class="avt">--}}
{{--                        <img src="https://hoanghamobile.com/avatar/Uploads/Avatar/38427-hoaiphanks35-gmail-com-637702346314663932.jpeg" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="info">--}}
{{--                        <p>--}}
{{--                            <strong>Phạm Thu Hoài</strong>--}}
{{--                            <i class="fas fa-check icon-checked"></i>--}}
{{--                            <span>QTV mua bán điện thoại</span>--}}
{{--                        </p>--}}
{{--                        <p><label><i>6 ngày trước</i></label></p>--}}
{{--                        <div class="content">--}}
{{--                            Chào anh chị--}}
{{--                            <br>--}}
{{--                            Dạ hiện sản phẩm đang còn hàng tại chi nhánh:--}}
{{--                            <br>--}}
{{--                            Số 2 Nguyễn Văn Cừ, TP Bắc Giang--}}
{{--                            <br>--}}
{{--                            Anh/chị vui lòng liên hệ số Hotline19002091 để đảm bảo tình trạng còn hàng cũng như được tư vấn thêm về sản phẩm trước khi qua mua hàng Anh/chị nhé.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="replyHolder replyCommentHolder">--}}
{{--                <input type="text" placeholder="Nhập bình luận của bạn">--}}
{{--                <button><i class="fas fa-paper-plane"></i></button>--}}
{{--            </div>--}}
{{--            <div class="form-container">--}}
{{--                <form action="">--}}
{{--                    <div class="rc-form comment-form">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <div class="control">--}}
{{--                                    <input type="text" placeholder="Họ tên *">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                <div class="control">--}}
{{--                                    <input type="text" placeholder="Điện thoại">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                <div class="control">--}}
{{--                                    <input type="text" placeholder="Email">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <div class="control">--}}
{{--                                    <textarea title="Nội dung" placeholder="Nội dung. Tối thiểu 15 ký tự *" name="Content" spellcheck="false" data-required="1" data-minlength="15"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <p class="note">Để gửi bình luận, bạn cần nhập tối thiểu trường họ tên và nội dung</p>--}}
{{--                            </div>--}}
{{--                            <div class="col col-end">--}}
{{--                                <button type="submit">--}}
{{--                                    <i class="fas fa-paper-plane "></i> Gửi bình luận--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
