{{-- Extends layout --}}
@extends('admin._layouts.master')


@section('action_area')
    <div class="d-flex align-items-center text-right">
        <a href="{{route('admin.user-qtv.index')}}"
           class="btn btn-light-primary font-weight-bolder mr-2">
            <i class="ki ki-long-arrow-back icon-sm"></i>
            Back
        </a>



        <div class="btn-group">
            <button type="button" class="btn btn-success font-weight-bolder btn-submit-custom" data-form="formMain" data-submit-close="1">
                <i class="ki ki-check icon-sm"></i>
                @if(isset($data))
                    {{__('Cập nhật')}}
                @else
                    {{__('Thêm mới')}}
                @endif

            </button>
            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split btn-submit-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <ul class="nav nav-hover flex-column">
                    <li class="nav-item">
                        <button  class="nav-link btn-submit-custom" data-form="formMain">
                            <i class="nav-icon flaticon2-reload"></i>
                            <span class="ml-2">
                                 @if(isset($data))
                                    {{__('Cập nhật & tiếp tục')}}
                                @else
                                    {{__('Thêm mới & tiếp tục')}}
                                @endif
                            </span>
                        </button>
                    </li>
                    {{--<li class="nav-item">--}}
                    {{--    <button  class="nav-link">--}}
                    {{--        <i class="nav-icon flaticon2-add-1"></i>--}}
                    {{--        <span class="ml-2">Save & add new</span>--}}
                    {{--    </button>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                    {{--    <a href="#" class="nav-link">--}}
                    {{--        <i class="nav-icon flaticon2-power"></i>--}}
                    {{--        <span class="nav-text">Save & exit</span>--}}
                    {{--    </a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>

        {{--<div class="btn-group">--}}
        {{--    <button type="button" class="btn btn-success  font-weight-bolder mr-2 btn-submit-custom" data-form="formMain" data-submit-close="1">--}}
        {{--        <i class="ki ki-check icon-sm"></i>--}}
        {{--        @if(isset($data))--}}
        {{--            {{__('Cập nhật & Đóng')}}--}}
        {{--        @else--}}
        {{--            {{__('Thêm mới & Đóng')}}--}}
        {{--        @endif--}}
        {{--    </button>--}}
        {{--</div>--}}

        {{--<div class="btn-group">--}}
        {{--    <button type="button" class="btn btn-success font-weight-bolder btn-submit-custom" data-form="formMain">--}}
        {{--        <i class="ki ki-check icon-sm"></i>--}}
        {{--        @if(isset($data))--}}
        {{--            {{__('Cập nhật')}}--}}
        {{--        @else--}}
        {{--            {{__('Thêm mới')}}--}}
        {{--        @endif--}}
        {{--    </button>--}}
        {{--</div>--}}




    </div>
@endsection

{{-- Content --}}
@section('content')


    {{Form::open(array('route'=>array('admin.user-qtv.post_set_permission',$data->id),'method'=>'POST','id'=>'formMain','enctype'=>"multipart/form-data"))}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            {{__($page_breadcrumbs[1]['title']??"")}} <i class="mr-2"></i>
                        </h3>
                    </div>

                </div>

                <div class="card-body">

                    @if(isset($data))
                        <div class="text-center">
                            <h3 class="bold">ID: {{$data->id}}</h3>
                            <h3 class="bold text-danger">Tài khoản: {{$data->username}}</h3>
                            <h3 class="bold text-danger">Email: {{$data->email}}</h3>

                        </div>



                    @endif

                    <div class="mt-10 mb-10">
                        <a href="#" id="btnToggleTree" class="btn btn-info m-btn" data-open="1">Thu gọn</a>
                        <a href="#" id="btnSelectAll" class="btn btn-success m-btn">Chọn tất cả</a>
                        <a href="#" id="btnDeselectAll" class="btn btn-danger m-btn">Bỏ tất cả</a>

                    </div>


                    <div id="kt_tree_3" class="tree-demo">
                    </div>

                    <input type="hidden" id="permission_ids" name="permission_ids" value="{{implode (",",old('permission_ids', isset($permissionsSelected) ? $permissionsSelected : []) )}}">



                    <style>
                        a[aria-level="1"] {
                            font-weight: bold;
                            font-size: 14px;
                            color: #716aca !important;
                        }
                    </style>
                    <script>





                    </script>

                </div>
            </div>
        </div>

    </div>

    {{ Form::close() }}

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection
{{-- Scripts Section --}}
@section('scripts')
    <script>
        "use strict";

        jQuery(document).ready(function () {
            // var jsondata = [
            //
            //
            //     {"id":"15","parent":"#","text": "Child 1"},
            //     { "id": "ajson3", "parent": "ajson3", "text": "Child 1"},
            //     { "id": "ajson4", "parent": "ajson2", "text": "Child 2"},
            // ];

            var jsondata={!! $permissionsJson !!};
            // var jsondata=[{"id":"15","parent":"13","text":"Ch\u1ec9nh s\u1eeda ng\u00f4n ng\u1eef"},{"id":"19","parent":"0","text":"Qu\u1ea3n l\u00fd t\u00e0i kho\u1ea3n"},{"id":"13","parent":"18","text":"Ng\u00f4n ng\u1eef"},{"id":"16","parent":"13","text":"X\u00f3a ng\u00f4n ng\u1eef"},{"id":"18","parent":"0","text":"H\u1ec7 th\u1ed1ng"}];

            $('#kt_tree_3').jstree({
                "plugins": ["wholerow", "checkbox", "types","search"],
                "core": {
                    "dblclick_toggle" : false,
                    "themes": {
                        "responsive": false,
                        "icons":false,
                        "dots": true,
                    },
                    "data": jsondata
                },

                "types": {
                    "default": {
                        "icon": "fa fa-folder text-warning"
                    },
                    "file": {
                        "icon": "fa fa-file  text-warning"
                    }
                },

            }).bind("loaded.jstree", function (e, data) {
                var perSelected=$('#permission_ids').val();

                var arrPer = perSelected.split(",");
                $.each(arrPer, function( index, value ) {

                    $('#kt_tree_3').jstree("select_node", value, true);
                });


            })
                .on('changed.jstree', function (e, data) {

                    var i, j, r = [];
                    for(i = 0, j = data.selected.length; i < j; i++) {

                        r.push(data.instance.get_node(data.selected[i]).id);
                    }
                    $('#permission_ids').val(r.join(','));
                });

            $( "#btnDeselectAll").click(function(e) {
                e.preventDefault();
                $("#kt_tree_3").jstree().deselect_all(true);
                $("#permission_ids").val('');
            });

            $( "#btnDeselectAll").click(function(e) {
                e.preventDefault();
                $("#kt_tree_3").jstree().uncheck_all(true);
            });

            $( "#btnSelectAll").click(function(e) {
                e.preventDefault();
                $("#kt_tree_3").jstree().check_all(true);
            });
            $( "#btnToggleTree").click(function(e) {
                var isOpen=$(this).data('open');

                if(isOpen){

                    $("#kt_tree_3").jstree('close_all');
                    $(this).data('open',0);
                    $(this).text('{{__('Mở rộng')}}');
                }
                else{
                    $("#kt_tree_3").jstree('open_all');
                    $(this).data('open',1);
                    $(this).text('{{__('Thu gọn')}}');
                }


            });

        });

        $(document).ready(function () {


            //btn submit form
            $('.btn-submit-custom').click(function (e) {
                e.preventDefault();
                var btn = this;
                $(".btn-submit-custom").each(function (index, value) {
                    KTUtil.btnWait(this, "spinner spinner-right spinner-white pr-15", '{{__('Chờ xử lý')}}', true);
                });
                $('.btn-submit-dropdown').prop('disabled', true);
                //gắn thêm hành động close khi submit
                $('#submit-close').val($(btn).data('submit-close'));
                var formSubmit = $('#' + $(btn).data('form'));
                formSubmit.submit();
            });

        });

    </script>




@endsection


