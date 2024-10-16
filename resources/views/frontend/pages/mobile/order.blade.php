@extends('frontend.layouts.master')
@section('content')
    <section>
        <div class="container">

            <div class="cart cart-checkout">
                <div class="header">
                    <div class="back">
                        <a href="/">
                            <i class="fas fa-chevron-left"></i>
                            <strong>Quay lại</strong>
                        </a>
                    </div>
                </div>

                <div class="just-center">
                    <div class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <label>Vui lòng kiểm tra lại thông tin đặt hàng dưới đây</label>
                    </div>
                </div>



                <div class="order-infomation">
                    <h3>1. Thông tin người đặt hàng</h3>
                    <table class="table talbe-order">
                        <tr>
                            <td class="label" style="width:110px;">{{config('order.detail.module.fullname.title')}}</td>
                            <td class="content">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.fullname.key'))}}</td>
                        </tr>
                        <tr>
                            <td class="label" style="width:75px;">{{config('order.detail.module.phone.title')}}</td>
                            <td class="content">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.phone.key'))}}</td>
                        </tr>
                        <tr>
                            <td class="label" style="width:75px;">{{config('order.detail.module.email.title')}}</td>
                            <td class="content">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.email.key'))}}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td class="label">Địa chỉ</td>--}}
{{--                            <td class="content">H&#224; Nội, Th&#250;y Lĩnh</td>--}}
{{--                        </tr>--}}


                        <tr>
                            <td class="label">Phương thức</td>
                            <td class="content">{{config('order.type.'.$data->type)}} </td>
                        </tr>

                        <tr>
                            <td class="label">{{config('order.detail.module.address.title')}}</td>
                            <td class="content" colspan="5">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.address.key'))}}</td>
                        </tr>

                        @if (isset($data->content))
                            <tr>
                                <td class="label">Ghi chú đặt hàng:</td>
                                <td colspan="5">{{$data->content}}</td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="order-infomation">
                    <h3>2. Danh sách sản phẩm đặt hàng</h3>
                    <table class="table table-border talbe-order table-product">
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>SL</th>
                            <th>Giá tiền</th>
                            <th>Tổng (SLxG)</th>
                        </tr>

{{--                        <tr>--}}
{{--                            <td align="center" valign="middle" rowspan="9">1</td>--}}
{{--                            <td>--}}
{{--                                <p><strong>Samsung Galaxy Z Flip3 5G - 128GB - Ch&#237;nh h&#227;ng</strong></p>--}}
{{--                                <p>128GB</p>--}}
{{--                                <p>Đen Phantom</p>--}}
{{--                            </td>--}}
{{--                            <td align="center">1</td>--}}
{{--                            <td align="center">20,190,000 ₫</td>--}}
{{--                            <td align="center">20,190,000 ₫</td>--}}
{{--                        </tr>--}}
{{--                        <tr class="text-darkgray">--}}
{{--                            <td colspan="2"><label class="bag">KM</label> <i> Sản phẩm đang thuộc chương tr&#236;nh Flash sale. mua chỉ với gi&#225; 20,190,000</i></td>--}}
{{--                            <td align="center">-00 ₫</td>--}}
{{--                            <td align="center">-00 ₫</td>--}}
{{--                        </tr>--}}
{{--                        <tr class="text-darkgray">--}}
{{--                            <td colspan="4"><label class="bag">KM</label> <i>Tặng sim data Mobifone Hera 5G (2.5GB/ng&#224;y) ( Chưa bao gồm th&#225;ng đầu ti&#234;n)- Lưu &#253;: chỉ mua trực tiếp tại cửa h&#224;ng, kh&#244;ng &#225;p dụng shop SIS H&#224; Nội</i></td>--}}
{{--                        </tr>--}}
{{--                        <tr class="text-darkgray">--}}
{{--                            <td colspan="4"><label class="bag">KM</label> <i>Tặng g&#243;i Samsung Care+ (1 năm rơi vỡ v&#224;o nước, 3 th&#225;ng bảo h&#224;nh mở rộng),  v&#224; Ph&#242;ng chờ hạng thương gia VIP Airport Lounge &amp; Ưu ti&#234;n s&#226;n bay Z Pass Priority.</i></td>--}}
{{--                        </tr>--}}
{{--                        <tr class="text-darkgray">--}}
{{--                            <td colspan="4"><label class="bag">KM</label> <i>[Thu cũ đổi mới] Giảm l&#234;n đến 4 triệu l&#234;n đời si&#234;u phẩm Galaxy Z Fold3 | Z Flip3 5G</i></td>--}}
{{--                        </tr>--}}
{{--                        <tr class="text-darkgray">--}}
{{--                            <td colspan="4"><label class="bag">KM</label> <i>Mua mỗi SP Samsung g&#243;p ngay 2022đ v&#224;o Quỹ hỗ trợ Trẻ em ngh&#232;o đ&#243;n Tết ấm (Từ 15/12/2021 - 15/01/2022)</i></td>--}}
{{--                        </tr>--}}
{{--                        <tr class="text-darkgray">--}}
{{--                            <td colspan="4"><label class="bag">KM</label> <i>Gi&#225; mua thẳng cho kh&#225;ch (D&#224;nh cho kh&#225;ch kh&#244;ng c&#243; Galaxy Gift): 22.990.000đ</i></td>--}}
{{--                        </tr>--}}
{{--                        <tr class="text-darkgray">--}}
{{--                            <td colspan="4"><label class="bag">KM</label> <i>Ưu đ&#227;i 500,000đ khi đăng k&#253; mở thẻ VIP Pearl</i></td>--}}
{{--                        </tr>--}}
{{--                        <tr class="text-darkgray">--}}
{{--                            <td colspan="4"><label class="bag">KM</label> <i>Giảm 50% cho Watch 4 (R870, R880, R885) khi mua k&#232;m Z Fold3, Z Flip3 (Tr&#234;n gi&#225; NY)</i></td>--}}
{{--                        </tr>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
                        @foreach ($detail as $key => $item)
                            @if ($item->module === "product")
                                <tr>
                                    <td align="center" valign="middle" rowspan="{{ isset($item->item->promotion) && count(json_decode($item->item->promotion)) > 1 ? count(json_decode($item->item->promotion)) + 1 : 1  }}">{{$key+1}}</td>
                                    <td><strong>{{$item->item->title}}</strong></td>
                                    <td align="center">{{$item->quantity}}</td>
                                    <td align="center">
                                        @php
                                            $val_order_detail = App\Library\HelperOrder::getAttribute($item->value);
                                        @endphp
                                        @if (isset($val_order_detail) && $val_order_detail != null)
                                            @foreach ($val_order_detail as $key_val_o => $item_val_o)
                                                - {{$item_val_o['key']}} : {{$item_val_o['value']}}
                                                <br />
                                            @endforeach
                                        @else
                                            Mặc định
                                        @endif
                                    </td>
                                    <td align="center">{{number_format($item->item->price)}} ₫</td>
                                    <td align="center">{{number_format($item->item->price_old)}} ₫</td>
                                </tr>
                                @if (isset($item->item->promotion))
                                    @foreach (json_decode($item->item->promotion) as $key => $item)
                                        <tr class="text-darkgray">
                                            <td colspan="6"><label class="bag">KM</label> <i>{{$item}}</i></td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                        @endforeach


                        <tr class="no-border">
                            <td colspan="4" align="right">Tổng tiền:</td>
                            <td>{{number_format($data->price)}} ₫</td>
                        </tr>

                        <tr class="no-border">
                            <td colspan="4" align="right">Giảm giá:</td>
                            <td>-{{number_format($data->price - $data->real_received_price)}} ₫</td>
                        </tr>
                        <tr class="no-border">
                            <td colspan="4" align="right">Tổng tiền thanh toán:</td>
                            <td><strong class="text-red">{{number_format($data->real_received_price)}} ₫</strong></td>
                        </tr>
                    </table>
                </div>




                <form class="cart-form" action="/cart/submit" method="post">
                    <input name="__RequestVerificationToken" type="hidden" value="ZKvFy7IKugS_BZ_b2q59yY0fCDOpcZ81TlvGn39eejiojS1LUfAyF-aRvKZOrd4mwTEg6dpo7NkYyFOBCv6Ty8y1IhE1" />
                    <div class="row">

                        <div class="control-button just-center">
                            <button type="submit"><i class="fas fa-check"></i> XÁC NHẬN ĐẶT HÀNG</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <iframe src="https://asia.creativecdn.com/tags?id=pr_n4X0y6ApZyJaHX1dNxQd_startorder" width="1" height="1" scrolling="no" frameBorder="0" style="display: none;"></iframe>


@endsection
