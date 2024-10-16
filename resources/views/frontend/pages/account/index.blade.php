@extends('frontend.layouts.master')
@section('content')
<section class="account">

    @include('frontend.pages.account.sidebar')
    <div class="body-content">
        <h1>Bảng điều khiển</h1>

        <div class="header">
            <div class="bg">
                <div class="text">
                    <h2>CHÀO MỪNG QUAY TRỞ LẠI, {{ isset($user)? $user->username : "" }}</h2>
                    <p><i>Tổng quát các hoạt động của bạn tại đây</i></p>
                </div>
            </div>
            <div class="icon">
                <img src="/assets/frontend/image/account_1.png" />
            </div>
        </div>



        <div class="account-layout">
            <div class="row equaHeight" data-obj=".col .box-bg-white">
                <div class="col">
                    <h3>Thông tin cá nhân</h3>
                    <div class="box-bg-white">
                        <div class="account-info">
                            <div class="tools">
                                <a href="/account/info" title="Thay đổi thông tin cá nhân"><i class="icon-edit-squad"></i></a>
                            </div>

                            <p><strong>Họ tên:</strong> <i>{{ isset($user)? $user->username : "" }}</i></p>
                            <p><strong>Tài khoản:</strong> <i>{{ isset($user->username)? $user->username : "" }}</i></p>
                            <p><strong>Ngày tháng năm sinh:</strong> <i>{{ isset($user->birtday)? $user->birtday : "" }}</i></p>
{{--                            <p><strong>Ngày tham gia:</strong> <i>11/02/2022</i></p>--}}
                            <p><strong>Email:</strong> <i>{{ isset($user->email)? $user->email : "" }}</i></p>
                            <p><strong>Địa chỉ:</strong> <i>{{ isset($user->address)? $user->address : "" }}</i></p>
                            <p><strong>Số điện thoại:</strong>  <i>{{ isset($user->phone)? $user->phone : "" }}</i></p>
                            <p><strong>Tên công ty:</strong> <i>{{ isset($user_meta['CompanyName'])? $user_meta['CompanyName'] : '' }}</i></p>
                            <p><strong>Địa chỉ công ty:</strong> <i>{{ isset($user_meta['CompanyAddress'])? $user_meta['CompanyAddress'] : '' }}</i></p>
                            <p><strong>Mã số thuế:</strong> <i>{{ isset($user_meta['CompanyID'])? $user_meta['CompanyID'] : '' }}</i></p>

                        </div>
                    </div>
                </div>

                <div class="col">
                    <h3>Đơn hàng đã đặt</h3>
                    <div class="box-bg-white">
                        <div style="padding:25px;">
                            <table class="table table-border table-lgpading">
                                <tr>
                                    <th>#</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Giảm giá</th>

                                </tr>

                                @foreach($data as $order)
                                <tr>
                                    <td>#</td>
                                    <td><a href="/account/order/{{$order->id}}">{{$order->id}}</a></td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->price}}</td>
                                    <td>@if($order->ratio)- {{$order->ratio}}@else - 0 @endif</td>

                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col" style="max-width:100%;">
                    <h3>Sản phẩm yêu thích</h3>
                    <div class="box-bg-white" style="padding:25px;">

{{--                        <div class="tools">--}}
{{--                            <a href="/account/wishlist" title="Chỉnh sửa danh sách sản phẩm yêu thích"><i class="icon-edit-squad"></i></a>--}}
{{--                        </div>--}}

                        <div style="max-width:100%; padding:0 30px;">
                            <div class="owl-carousel owl-reponsive lr-slider favorite_desktop">
                                @if(isset($favorite) && count($favorite)>0)
                                @foreach ($favorite as $key => $item)
                                <div class="item">
                                    <div class="img">
                                        <a href="/{{isset($item->item->url) ? $item->item->url : $item->item->slug}}">
                                            <img src="{{ isset($item->item->image)?\App\Library\Files::media($item->item->image) : null }}" alt="{{isset($item->item->title) ? $item->item->title : null}}">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="/{{isset($item->item->url) ? $item->item->url : $item->item->slug}}" class="title" title="{{isset($item->item->title) ? $item->item->title : null}}">{{isset($item->item->title) ? $item->item->title : null}}</a>
                                        <span class="price">
                                              <strong>{{number_format($item->item->price)}} ₫</strong>
                                               @if (isset($item->item->percent_sale) && (int)$item->item->percent_sale > 0)
                                                <strike>{{number_format($item->item->price_old)}} ₫</strike>
                                            @endif
                                         </span>
                                    </div>

                                    @if (isset($item->item->promotion) && $item->item->promotion != "")
                                        <div class="note">
                                            <span class="bag">KM</span> <label title="{{json_decode($item->item->promotion)[0]}}">{{\Str::limit(json_decode($item->item->promotion)[0],32)}}</label>
                                            @if (count(json_decode($item->item->promotion)) > 1)
                                                <strong class="text-orange">VÀ {{count(json_decode($item->item->promotion)) - 1}} KM KHÁC</strong>
                                            @endif
                                        </div>
                                    @endif
                                    @if (isset($item->item->promotion) && $item->item->promotion != "")
                                        <div class="promote">
                                            <a href="/{{isset($item->item->url) ? $item->item->url : $item->item->slug}}">
                                                <ul>
                                                    @foreach (json_decode($item->item->promotion) as $item)
                                                        <li><span class="bag">KM</span> {{$item}}</li>
                                                    @endforeach
                                                </ul>
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                @endforeach
                                    @else
                                        <p>Bạn chưa có sản phẩm yêu thích</p>
                                    @endif

                            </div>

                            <div class="lts-product col-product favorite_mobile">
                                @if(isset($favorite) && count($favorite)>0)
                                    @foreach ($favorite as $key => $item)
                                <div class="item">
                                    <div class="img">
                                        <a href="/{{isset($item->item->url) ? $item->item->url : $item->item->slug}}">
                                            <img src="{{ isset($item->item->image)?\App\Library\Files::media($item->item->image) : null }}" alt="{{isset($item->item->title) ? $item->item->title : null}}">
                                        </a>
                                    </div>

{{--                                    <div class="sticker sticker-left">--}}
{{--                                        <span><img src="/Content/web/sticker/apple.png" title="Ch&#237;nh h&#227;ng Apple" /></span>--}}
{{--                                    </div>--}}
                                    <div class="info">
                                        <a href="/{{isset($item->item->url) ? $item->item->url : $item->item->slug}}" class="title" title="{{isset($item->item->title) ? $item->item->title : null}}">{{isset($item->item->title) ? $item->item->title : null}}</a>
                                        <span class="price">
                                              <strong>{{number_format($item->item->price)}} ₫</strong>
                                               @if (isset($item->item->percent_sale) && (int)$item->item->percent_sale > 0)
                                                <strike>{{number_format($item->item->price_old)}} ₫</strike>
                                            @endif
                                         </span>
                                    </div>
                                    @if (isset($item->item->promotion) && $item->item->promotion != "")
                                        <div class="note">
                                            <span class="bag">KM</span> <label title="{{json_decode($item->item->promotion)[0]}}">{{\Str::limit(json_decode($item->item->promotion)[0],32)}}</label>
                                            @if (count(json_decode($item->item->promotion)) > 1)
                                                <strong class="text-orange">VÀ {{count(json_decode($item->item->promotion)) - 1}} KM KHÁC</strong>
                                            @endif
                                        </div>
                                    @endif
                                    @if (isset($item->item->promotion) && $item->item->promotion != "")
                                        <div class="promote">
                                            <a href="/{{isset($item->item->url) ? $item->item->url : $item->item->slug}}">
                                                <ul>
                                                    @foreach (json_decode($item->item->promotion) as $item)
                                                        <li><span class="bag">KM</span> {{$item}}</li>
                                                    @endforeach
                                                </ul>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                @endforeach
                                @else
                                    <p>Bạn chưa có sản phẩm yêu thích</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <h3>Quản lý đánh giá</h3>--}}

{{--                    <div class="box-bg-white" style="padding:25px;">--}}

{{--                        <div class="tools">--}}
{{--                            <a href="/account/review" title="Xem tất cả các đánh giá bạn đã gửi"><i class="icon-eye"></i></a>--}}
{{--                        </div>--}}

{{--                        <div class="review-content comment-content" style="max-width:100%; padding:0 30px;">--}}
{{--                            <p>Bạn chưa gửi đánh giá nào cả.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="row">
                <div class="col">
                    <h3>Quản lý bình luận</h3>

                    <div class="box-bg-white" style="padding:25px;">

                        <div class="tools">
                            <a href="/account/comment" title="Xem tất cả các bình luận bạn đã gửi"><i class="icon-eye"></i></a>
                        </div>

                        <div class="review-content comment-content" style="max-width:100%; padding:0 30px;">

                            @if(isset($comment) && count($comment) >0)

                                @foreach($comment as $item)

                                    <div class="item item-selected">
                                        <div class="avt">
                                            <img src="{{$item->user->image ? $item->user->image : null}}" />
                                        </div>
                                        <div class="info">
                                            <p>
                                                <strong class="name">{{$item->user->username ? $item->user->username : null}}</strong>
                                            </p>
                                            <p>
                                                <label>
                                                    <i>
                                                        {{$item->created_at}}
                                                        @if(isset($item->item))

                                                        <span>- bài viết gốc:</span> <a target="_blank" href="/{{$item->item->url ? $item->item->url : $item->item->slug }}">{{$item->item->title ? $item->item->title : '' }}</a>
                                                        @endif
                                                    </i>
                                                </label>
                                            </p>
                                            <div class="content">
                                                {{$item->content}}
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            @else
                                <p>Bạn chưa gửi bình luận nào cả.</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <script>
        $(document).ready(function () {
            $('.activeindex').addClass('active')
        })
    </script>
</section>
@endsection
