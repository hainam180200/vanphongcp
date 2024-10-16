{{-- Extends layout --}}
@extends('admin._layouts.master')
@section('action_area')
@endsection
{{-- Content --}}
@section('content')
@php
$params = json_decode($data->params);
@endphp
<div class="card card-custom" id="kt_page_sticky_card">
   <div class="card-header">
      <div class="card-title">
         <h3 class="card-label">
            <span> {{__('Chi tiết đơn hàng')}} #{{$data->id}}</span> <i class="mr-2"></i>
            <br/>
            @if ($data->status == 1)
            <span class="label label-lg label-pill label-inline label-success mr-2">{{config('module.store-card.status.1')}}</span>
            @elseif($data->status == 2)    
            <span class="label label-lg label-pill label-inline label-warning mr-2">{{config('module.store-card.status.2')}}</span>
            @elseif($data->status == 3)
            <span class="label label-lg label-pill label-inline label-info mr-2">{{config('module.store-card.status.3')}}</span>
            @elseif($data->status == 4)
            <span class="label label-lg label-pill label-inline label-dark mr-2">{{config('module.store-card.status.4')}}</span>
            @elseif($data->status == 5)
            <span class="label label-lg label-pill label-inline label-primary mr-2">{{config('module.store-card.status.5')}}</span>
            @elseif($data->status == 0)
            <span class="label label-lg label-pill label-inline label-danger mr-2">{{config('module.store-card.status.0')}}</span>
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
                  Khách hàng:
               </th>
               <th class="th-value">
                  <span style="font-weight:bold;color:#000">
                    {{$data->author->id}} 
                    - {{$data->author->fullname_display}} 
                    @if (isset($data->author->email))
                    - {{$data->author->email}} 
                    @endif
                </span>
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  Nhà cung cấp dịch vụ
               </th>
               <th class="th-value">
                  <span style="font-weight:bold;color:#000">{{config('module.store-card.gate_id.'.$data->gate_id)}}</span> - {{$data->tranid}}
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  Nhà mạng
               </th>
               <th class="th-value">
                  {{$params->telecom}}
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  Mệnh giá
               </th>
               <th class="th-value">
                    {{number_format($params->amount)}}
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  Số lượng
               </th>
               <th class="th-value">
                  {{$params->quantity}}
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  Trị giá
               </th>
               <th class="th-value">
                  {{number_format($data->price)}} VNĐ
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  Chiết khấu
               </th>
               <th class="th-value">
                  {{$data->ratio}} %
               </th>
            </tr>
            <tr>
               <th class="th-index">
                  #
               </th>
               <th class="th-name">
                  Nội dung - Mã lỗi
               </th>
               <th class="th-value">
                  {{$data->description}}
               </th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                 <b> #</b>
               </td>
               <td>
                  <b>Tổng tiền </b>
               </td>
               <td>
                  <b>{{number_format($data->real_received_price)}} VNĐ</b>
               </td>
            </tr>
         </tbody>
      </table>
      {{Form::open(array('route'=>array('admin.store-card.update-item',$data->id),'method'=>'POST','enctype'=>"multipart/form-data"))}}
      <div class="form-group row">
            <div class="col-12 col-md-6">
                <label class="form-control-label">Trạng thái</label>
                {{Form::select('status',config('module.store-card.status'),old('status', isset($data) ? $data->status : null),array('class'=>'form-control select-option'))}}
            </div>
      </div>
        <button type="button" class="btn btn-success font-weight-bolder btn-submit-custom button-status" style="display: none" data-toggle="modal" data-target="#updateModal">
            {{__('Cập nhật')}}
        </button>
    {{ Form::close() }}
   </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div style="text-align:initial;" class="modal-dialog">
        <div class="modal-content">
            {{Form::open(array('route'=>array('admin.store-card.update-item',$data->id),'class'=>'m-form','method'=>'POST'))}}
            <div class="modal-header">
                <h4 class="modal-title">Thay đổi trạng thái đơn hàng</h4>
                <div style="display: none" class="select-status"></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                Bạn muốn thay đổi trạng thái đơn hàng này? Nếu cập nhật về trạng thái thất bại, khách  hàng sẽ được hoàn tiền
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