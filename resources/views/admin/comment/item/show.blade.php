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
                    <span> {{__('Bình luận ')}} #{{$data->id}}</span> <i class="mr-2"></i>
                    <br/>
                    <br/>

                </h3>
            </div>
            <div class="card-toolbar"><b>{{__('Sản phẩm ')}} #{{$data->item->title}} <i class="mr-2"></i></b></div>
        </div>


        <div class="card-body">
            <h3> Bình luận của {{$data->user->username}}</h3>
            <table class="table table-border " style="color: #000;font-size:14px">
                <tbody>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Người bình luận</th>
                    <th>Trạng thái</th>
                    <th>Nội dung</th>
                </tr>

                <tr>
                    <td align="center" valign="middle" rowspan=""><b > {{ isset($data->id) ? $data->id : ''}}</b></td>
                    <td><strong><b ><a href="/{{$data->item->url ? $data->item->url : $data->item->slug}}">{{$data->item->title}}</a> </b></strong></td>
                    <td><strong><b style="">{{$data->user->username}}</b></strong></td>
                    <td align="center">
                        @if ($data->status == 0)
                            <span class="label label-lg label-pill label-inline label-danger mr-2">{{config('comment.status.0')}}</span>
                        @elseif ($data->status == 1)
                            <span class="label label-lg label-pill label-inline label-dark mr-2">{{config('comment.status.1')}}</span>
                        @else
                            ""
                        @endif
                    </td>
                    <td align="center">{{$data->content}}</td>
                </tr>

                </tbody>
            </table>
            {{Form::open(array('route'=>array('admin.order.update-item',$data->id),'method'=>'POST','enctype'=>"multipart/form-data"))}}
            <div class="form-group row">
                <div class="col-12 col-md-6">
                    <label class="form-control-label">Trạng thái</label>
                    {{Form::select('status',config('comment.status'),old('status', isset($data) ? $data->status : null),array('class'=>'form-control select-option'))}}
                    <br>
                    <button type="button" class="btn btn-success font-weight-bolder btn-submit-custom button-status" style="display: none;" data-toggle="modal" data-target="#updateModal">
                        {{__('Cập nhật bình luận')}}
                    </button>
                </div>
{{--                <div class="col-12 col-md-6">--}}
{{--                    <label class="form-control-label">Ghi chú thêm</label>--}}
{{--                    <textarea id="note" name="note" class="form-control ckeditor-basic" data-height="150"  data-startup-mode="" >{{ old('note', isset($data) ? $data->note : null) }}</textarea>--}}
{{--                </div>--}}

            </div>
            {{ Form::close() }}
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="basic" aria-hidden="true">
        <div style="text-align:initial;" class="modal-dialog">
            <div class="modal-content">
                {{Form::open(array('route'=>array('admin.comment.update-item',$data->id),'class'=>'m-form','method'=>'POST'))}}
                <div class="modal-header">
                    <h4 class="modal-title">Thay đổi trạng thái bình luận</h4>
                    <div style="display: none" class="select-status"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    Bạn muốn thay đổi trạng thái bình luận này?
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
