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
               <label>THÔNG TIN ĐƠN HÀNG SỐ <span class="text-orange">{{$data->id}}</span></label>
            </div>
         </div>
         <div class="order-infomation">
            <h3>1. Thông tin người đặt hàng</h3>
            <table class="table talbe-order">
               <tr>
                  <td class="label" style="width:110px;">{{config('order.detail.module.fullname.title')}}</td>
                  <td class="content">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.fullname.key'))}}</td>
                  <td class="label" style="width:95px;">{{config('order.detail.module.phone.title')}}</td>
                  <td class="content">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.phone.key'))}}</td>
                  <td class="label" style="width:75px;">{{config('order.detail.module.email.title')}}</td>
                  <td class="content">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.email.key'))}}</td>
               </tr>
               <tr>
                  <td class="label">Phương thức</td>
                  <td class="content">{{config('order.type.'.$data->type)}} </td>
                  {{-- <td>Nhận hàng tại</td>
                  <td>
                     <span> Chưa xác thực </span>
                  </td> --}}
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
               <tbody>
                  <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>SL</th>
                    <th>Thông tin chi tiết</th>
                    <th>Giá tiền</th>
                    <th>Tổng (SLxG)</th>
                  </tr>
                  @foreach ($detail as $key => $item)
                  @if ($item->module === "product")
                  @php
                     $quantity = $item->quantity
                  @endphp
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
                        <td align="center">{{number_format($quantity * $item->item->price)}} ₫</td>
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
                     <td colspan="5" align="right">Tổng tiền:</td>
                     <td>{{number_format($data->price)}} ₫</td>
                  </tr>
                  <tr class="no-border">
                     <td colspan="5" align="right">Giảm giá:</td>
                     <td>-{{number_format($data->price - $data->real_received_price)}} ₫</td>
                  </tr>
                  <tr class="no-border">
                     <td colspan="5" align="right">Tổng tiền thanh toán:</td>
                     <td><strong class="text-red">{{number_format($data->real_received_price)}} ₫</strong></td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="order-infomation">
            <h3>3. Lịch sử đơn hàng</h3>
            <table class="table talbe-order table-border">
               <tr>
                  <th>#</th>
                  <th>Trạng thái</th>
                  <th>Người gửi</th>
                  <th>Ghi chú</th>
                  <th>Thời gian</th>
               </tr>
               <tr>
                  <td>1</td>
                  <td>Gửi y&#234;u cầu đặt h&#224;ng</td>
                  <td>abc</td>
                  <td>12345678910111213141516</td>
                  <td>Vừa xong</td>
               </tr>
            </table>
         </div>
         <form class="cart-form" action="/cart/submit" method="post">
            <div class="row">
                <div class="control-button just-center">
                    <button type="submit"><i class="icon-checked"></i> XÁC NHẬN ĐẶT HÀNG</button>
                </div>
            </div>
        </form>
      </div>
   </div>
</section>
@endsection