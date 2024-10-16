{{-- Extends layout --}}
@extends('admin._layouts.master')
@section('action_area')
@endsection
{{-- Content --}}
@section('content')
<div class="card card-custom" id="kt_page_sticky_card">
   <div class="card-header">
      <div class="card-title">
         <h3 class="card-label">
            <span> {{__('Chi tiết đơn hàng')}} #{{$data->id}}</span> <i class="mr-2"></i>
            <br/>
            @if ($data->status == 0)
            <span class="label label-lg label-pill label-inline label-danger mr-2">{{config('order.status.0')}}</span>
            @elseif ($data->status == 1)
            <span class="label label-lg label-pill label-inline label-success mr-2">{{config('order.status.1')}}</span>
            @elseif($data->status == 2)    
            <span class="label label-lg label-pill label-inline label-warning mr-2">{{config('order.status.2')}}</span>
            @elseif($data->status == 3)
            <span class="label label-lg label-pill label-inline label-info mr-2">{{config('order.status.3')}}</span>
            @else
            ""
            @endif
         </h3>
      </div>
      <div class="card-toolbar"></div>
   </div>
   <div class="card-body">
      <table class="table">
         <thead class="thead-default">
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  Tài khoản:
               </th>
               <th class="th-value">
                  <span style="font-weight:bold;color:#000">
                  {{$data->author->username}} 
                  </span>
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  {{config('order.detail.module.fullname.title')}}
               </th>
               <th class="th-value">
                  {{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.fullname.key'))}}
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  {{config('order.detail.module.phone.title')}}
               </th>
               <th class="th-value">
                  {{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.phone.key'))}}
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  {{config('order.detail.module.email.title')}}
               </th>
               <th class="th-value">
                  {{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.email.key'))}}
               </th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  <b> #</b>
               </td>
               <td>
                  <b>Ghi chú:</b>
               </td>
               <td>
                  @if (isset($data->content))
                  <b>{{$data->content}}</b>
                  @else    
                  <b>Không có</b>
                  @endif
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <hr>
   <div class="card-body">
      <h3> Danh sách sản phẩm mong muốn trả góp</h3>
      <table class="table table-border " style="color: #000;font-size:14px">
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
               <td><strong><b style="font-size:18px">{{$item->item->title}}</b></strong></td>
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
               <td colspan="6"><i style="color: #000;font-size:13px"><b>- {{$item}}</b></i></td>
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
               <td><strong class="text-red" style="font-size: 18px">{{number_format($data->real_received_price)}} ₫</strong></td>
            </tr>
         </tbody>
      </table>
    {{Form::open(array('route'=>array('admin.installment-report.update-item',$data->id),'method'=>'POST','enctype'=>"multipart/form-data"))}}
        <div class="form-group row">
            <div class="col-12 col-md-6">
                <label class="form-control-label">Trạng thái</label>
                {{Form::select('status',config('module.installment-report.status'),old('status', isset($data) ? $data->status : null),array('class'=>'form-control select-option'))}}
                <br>
                <button type="button" class="btn btn-success font-weight-bolder btn-submit-custom button-status" style="display: none;" data-toggle="modal" data-target="#updateModal">
                    {{__('Cập nhật đơn hàng')}}
                </button>
            </div>
            <div class="col-12 col-md-6">
               <label class="form-control-label">Ghi chú thêm</label>
               <textarea id="note" name="note" class="form-control ckeditor-basic" data-height="150"  data-startup-mode="" >{{ old('note', isset($data) ? $data->note : null) }}</textarea>
            </div>
          
        </div>
    {{ Form::close() }}
   </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div style="text-align:initial;" class="modal-dialog">
        <div class="modal-content">
            {{Form::open(array('route'=>array('admin.installment-report.update-item',$data->id),'class'=>'m-form','method'=>'POST'))}}
            <div class="modal-header">
                <h4 class="modal-title">Thay đổi trạng thái đơn hàng</h4>
                <div style="display: none" class="select-status"></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                Bạn muốn thay đổi trạng thái đơn hàng này?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary m-btn m-btn--air btn-danger">Xác nhận</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('.select-option').on('change',function(){
       val = $(this).val();
       $('.select-status').html('<input name="status" value='+val+'>');
       $('.button-status').css('display','block');
    })
 </script>
@endsection