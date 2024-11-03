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
                    <span> {{__('Ý kiến ')}} <b>#{{$data->id}}</b>  - Bình luận của <b> {{$data->author}}</b></span> <i class="mr-2"></i>

                </h3>
            </div>
        </div>


        <div class="card-body">
            <table class="table table-border " style="color: #000;font-size:14px">
                <tbody>
                <tr>
                    <td >#</td>
                    <td  rowspan=""><b > {{ isset($data->id) ? $data->id : ''}}</b></td>
                </tr>
                <tr>
                    <th >Tiêu đề</th>
                    <td  rowspan="">{{ isset($data->title) ? $data->title : ''}}</td>
                </tr>
                <tr>
                    <th >Người bình luận</th>
                    <td >{{ isset($data->author) ? $data->author : ''}}</td>
                </tr>
                <tr>
                    <th >Địa chỉ</th>
                    <td >{{ isset($data->address) ? $data->address : ''}}</td>
                </tr>
                <tr>
                    <th >Số điện thoại</th>
                    <td >{{ isset($data->phone) ? $data->phone : ''}}</td>
                </tr>
                <tr>
                    <th >Email</th>
                    <td >{{ isset($data->email) ? $data->email : ''}}</td>
                </tr>
                <tr>
                    <th >Chuyên mục</th>
                    <td >
                        @if ($data->type == 1)
                            <span class="label label-lg label-pill label-inline label-danger mr-2">{{config('module.comment.type.1')}}</span>
                        @elseif ($data->type == 2)
                            <span class="label label-lg label-pill label-inline label-dark mr-2">{{config('module.comment.type.2')}}</span>
                        @else
                            ""
                        @endif
                    </td>
                </tr>
                <tr>
                    <th >Nội dung</th>
                     <td >{{$data->content}}</td>

                </tr>

                </tbody>
            </table>

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
