@extends('frontend.layouts.master')
@section('content')
<section>
    <div class="container">
        <div class="cart">
            <div class="cart-layout">
                <div class="cart-info" id="cartInfo">
                    @if (isset($cart) && count($cart) > 0)
                        <div class="cart-icon">
                            <i class="far fa-check-circle"></i>
                            <label>Giỏ hàng</label>
                        </div>
                    @else
                        <div class="cart-icon">
                            <i class="far fa-check-circle"></i>
                            <label>Giỏ hàng rỗng</label>
                        </div>
                    @endif

                @if (isset($cart) && count($cart) > 0)
                    <div class="cart-items">
                        @foreach ($cart as $key => $item)
                        <div class="item cart-item-el-{{$item->row_id}}" data-rowId="{{$item->row_id}}">
                            <div class="img">
                                <img src="{{\App\Library\Files::media($item->image)}}" alt="{{$item->title}}" />
                                <p class="title">{{$item->title}}</p>
                                <p class="price">
{{--                                    <i class="icon-flash text-red"></i>--}}
                                    <strong>{{number_format($item->price) }} ₫</strong>

                                    @if ($item->price_base > $item->price)
                                        <strike>{{number_format($item->price_base)}} ₫</strike>
                                    @endif
                                </p>
                                <div class="number">
                                    <label>Số lượng</label>
                                    <div class="control">
                                        <button class="cartMinutes" data-rowId="{{$item->row_id}}">-</button>
                                        <input type="text" class="cartOnchange cart-item-val-{{$item->row_id}}" data-rowId="{{$item->row_id}}" value="{{$item->qty}}" disabled />
                                        <button class="cartPlus" data-rowId="{{$item->row_id}}">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="edit">
                                    <a href="javascript:;" class="red btn-delete-item-cart" data-rowId="{{$item->row_id}}" ><i class="fas fa-minus"></i></a>
                                </div>
                                @if (isset($item->promotion))
                                    <div class="promote">
                                        @foreach (json_decode($item->promotion) as $key => $item_promotion)
                                            <div class="offer-items" id="of_FLIP3D">
                                                <div class="offer">
                                                    <div class="stt">
                                                        <label>KM{{$key+1}}</label>
                                                    </div>
                                                    <div class="offer-border">
                                                        <div class="content">
                                                            <label class="radio-ctn">
                                                                <span>{{$item_promotion}}</span>
                                                                <input checked class="cart-promote" type="radio" name="" value="">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if (isset($item->options_content) && count($item->options_content) > 0)
                                    <div class="options">
                                        @foreach ($item->options_content as $key => $item)
                                            <div class="option">
                                                <strong>{{$item['name']}}</strong>
                                                <label>
                                                    <i class="fas fa-check"></i>
                                                    <span>{{$item['val']}}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                        </div>
                        @endforeach
                    </div>

                    <div class="cart-total">
                        <p>Tổng giá trị: <strong class="price" id="price">{{number_format($total)}} ₫</strong> </p>
                        @if ($total_base - $total > 0)
                            <p>Giảm giá: <strong class="price" id="price_base">{{number_format($total_base - $total )}} ₫</strong></p>
                        @endif
                        <p>Tổng thanh toán: <strong class="price text-red" id="sum_price">{{number_format($total)}} ₫</strong></p>
                        <p><i style="color: red" id="content_price">{{ucfirst(\App\Library\Helpers::StringMoney($total))}}</i></p>
                        <button class="next">Tiếp tục</button>
                    </div>
                @else

                @endif
                </div>

                @if (isset($cart) && count($cart) > 0)
                    <div class="cart-form" style="display:none;">
                        <div class="back">
                            <a href="/;" class="showInfo">
                                <i class="fas fa-chevron-left"></i>
                                <strong>Quay lại</strong>
                            </a>
                        </div>

                        <form method="POST" action="/order" >
                            {{ csrf_field() }}
{{--                            <input type="hidden" name="OrderPayTypeID" value="1" />--}}

{{--                            <input type="hidden" name="IsPreOrder" id="IsPreOrder" value="False" />--}}

{{--                            <input name="__RequestVerificationToken" type="hidden" value="m5TFgu7XCzBJ87BSblpZW4zsixC54PfgwLHtzA3KD2jUTXPfJdDPvsEPs5t96WqA3zMUrewPAR4LoEQLDh-Px7OgwZo1" />--}}
                            <h3>Thông tin đặt hàng</h3>
                            <p class="text-gray"><i>Bạn cần nhập đầy đủ các trường thông tin có dấu *</i></p>
                            <div class="row">
                                <div class="col">
                                    @if (auth()->guard('frontend')->check())
                                        <div class="control">
                                            <input type="text" value="{{auth()->guard('frontend')->user()->username}}" readonly />
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="control">
                                        <input name="fullname" value="{{isset(auth()->guard('frontend')->user()->fullname) ? auth()->guard('frontend')->user()->fullname : null }}" type="text" placeholder="Họ và tên *" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="control">
                                        <input name="phone" type="phone" value="{{isset(auth()->guard('frontend')->user()->phone) ? auth()->guard('frontend')->user()->phone : null }}" placeholder="Số điện thoại *" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="control">
                                        @include('frontend.widget.desktop._system_address_provinces')
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="control">
                                        <select id="districts" name="districts" placeholder="Quận/Huyện *" required>
                                            <option value="">Quận/Huyện *</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="IsDelivery" style="display:none">
                                <p class="text-red"><i class="icon-news"></i> Do tình hình dịch bệnh phức tạp, khu vực quý khách chọn tạm ngưng giao hàng. Hoàng Hà sẽ giao hàng trở lại khi được cho phép. Mong quý khách hàng thông cảm. Hoàng Hà thành thật xin lỗi vì sự bất tiện này.</p>
                            </div>
                            <div class="row shInfo">
                                <div class="col">
                                    <div class="control">
                                        <input name="address" type="text" placeholder="Địa chỉ nhận hàng *" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row shInfo">
                                <div class="col">
                                    <div class="control">
                                        <input name="email" value="{{isset(auth()->guard('frontend')->user()->email) ? auth()->guard('frontend')->user()->email : null }}" type="email" placeholder="Email" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row shInfo">
                                <div class="col">
                                    <div class="control">
                                        <textarea name="note" placeholder="Ghi chú" spellcheck="false" data-minlength="15"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row shInfo">
                                @if (auth()->guard('frontend')->check())
                                    <div class="control-button">
                                        <button type="submit">XÁC NHẬN VÀ ĐẶT TRƯỚC</button>
                                    </div>
                                @else
                                    <div class="control-button">
                                        <a href="/login"><button type="button">VUI LÒNG ĐĂNG NHẬP ĐỂ ĐẶT HÀNG</button></a>
                                    </div>
                                @endif
                            </div>



{{--                            <div class="row shInfo">--}}
{{--                                <div class="col">--}}
{{--                                    <div class="control">--}}
{{--                                        <textarea name="Note" placeholder="Ghi chú" spellcheck="false" data-minlength="15"></textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div class="row shInfo">--}}
{{--                                <div class="col-center">--}}
{{--                                    <div class="control">--}}
{{--                                        <input name="Counpon" type="text" placeholder="Mã giảm giá (Nếu có)" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row shInfo">--}}
{{--                                <div class="control-button">--}}
{{--                                    <button type="submit">XÁC NHẬN VÀ ĐẶT HÀNG</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </form>

                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<iframe src="https://asia.creativecdn.com/tags?id=pr_n4X0y6ApZyJaHX1dNxQd_basketstatus_1259" width="1" height="1" scrolling="no" frameBorder="0" style="display: none;"></iframe>

@endsection
