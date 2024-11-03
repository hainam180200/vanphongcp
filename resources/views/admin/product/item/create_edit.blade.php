{{-- Extends layout --}}
@extends('admin._layouts.master')

@section('action_area')
    <div class="d-flex align-items-center text-right">
        <a href="{{route('admin.'.$module.'.index')}}"
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
                </ul>
            </div>
        </div>
    </div>
@endsection

{{-- Content --}}
@section('content')

    @if(isset($data))
        {{Form::open(array('route'=>array('admin.'.$module.'.update',$data->id),'method'=>'PUT','id'=>'formMain','enctype'=>"multipart/form-data" , 'files' => true))}}
    @else
        {{Form::open(array('route'=>array('admin.'.$module.'.store'),'method'=>'POST','id'=>'formMain','enctype'=>"multipart/form-data"))}}
    @endif
    <input type="hidden" name="submit-close" id="submit-close">

    <div class="row">
        <div class="col-lg-9">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            {{__($page_breadcrumbs[0]['title'])}} <i class="mr-2"></i>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    {{-----group_id------}}
                    <div class="form-group row">
                        <label  class="col-12">{{ __('Danh mục cha') }}</label>
                        <div class="col-6">
                            <select name="group_id[]" class="form-control select2 col-md-5" id="kt_select2_2"  data-placeholder="-- {{__('Không chọn')}} --"   style="width: 100%" >
                                @if( !empty(old('group_id')) )
                                    {!!\App\Library\Helpers::buildMenuDropdownList($dataCategory,old('group_id')) !!}
                                @else
                                    <?php $itSelect = [] ?>
                                    @if(isset($data))
                                        @foreach($data->groups as $gr)
                                            <?php array_push($itSelect, $gr->id)?>
                                        @endforeach
                                    @endif
                                    {!!\App\Library\Helpers::buildMenuDropdownList($dataCategory,$itSelect) !!}
                                @endif
                            </select>
                            @if($errors->has('group_id'))
                                <div class="form-control-feedback">{{ $errors->first('group_id') }}</div>
                            @endif
                        </div>
                    </div>
                    {{-----title------}}
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <label>{{ __('Tiêu đề') }}</label>
                            <input type="text" id="title_gen_slug" name="title" value="{{ old('title', isset($data) ? $data->title : null) }}" autofocus="true"
                                   placeholder="{{ __('Tiêu đề') }}" maxlength="120"
                                   class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}">
                            @if ($errors->has('title'))
                                <span class="form-text text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-----slug------}}
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <label>{{ __('Permalink') }}:</label>
                            <span class="">
                                <a  id="permalink" class="permalink" target="_blank" href="{{Request::getSchemeAndHttpHost()}}/{{ old('slug', isset($data) ? $data->slug : null) }}">
                                <span class="default-slug">{{Request::getSchemeAndHttpHost()}}/<span id="label-slug" data-override-edit="0">{{ old('slug', isset($data) ? $data->slug : null) }}</span></span>
                                </a>
                                <input type="text" value=""  class="form-control" id="input-slug-edit" style="width: auto !important;display: none"/>
                                <a  class="btn btn-light-primary font-weight-bolder mr-2" id="btn-slug-edit">Chỉnh sửa</a>
                                <a  class="btn btn-light-primary font-weight-bolder mr-2" id="btn-slug-renew">Tạo mới</a>
                                <a  class="btn btn-light-primary font-weight-bolder mr-2" id="btn-slug-ok" style="display: none">OK</a>
                                <a  class="btn btn-secondary  button-link mr-2" id="btn-slug-cancel" style="display: none">Cancel</a>

                                <input type="hidden" id="current-slug" name="slug" value="{{ old('slug', isset($data) ? $data->slug : null) }}">
                                <input type="hidden" id="is_slug_override" name="is_slug_override" value="{{ old('is_slug_override', isset($data) ? $data->is_slug_override : null) }}" >
                            </span>
                        </div>
                    </div>
                    {{-----description------}}
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <label for="locale">{{ __('Trích yếu') }}:</label>
                            <textarea id="description" name="description" class="form-control ckeditor-basic" data-height="150"  data-startup-mode="" >{{ old('description', isset($data) ? $data->description : null) }}</textarea>
                            @if ($errors->has('description'))
                                <span class="form-text text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-----content------}}
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <label for="locale">{{ __('Nội dung') }}</label>
                            <textarea id="content" name="content" class="form-control ckeditor-source" data-height="400"   data-startup-mode="" >{{ old('content', isset($data) ? $data->content : null) }}</textarea>
                            @if ($errors->has('content'))
                                <span class="form-text text-danger">{{ $errors->first('content') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-----gallery block------}}
                    <div class="form-group row">
                        {{-----image------}}
                        <div class="col-md-4">
                            <label for="locale">{{ __('Ảnh đại diện') }}:</label>
                            <div class="">
                                <div class="fileinput  {{ old('image', isset($data) ? $data->image : null)!=""?"fileinput-exists":"fileinput-new" }}  " data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                        <img src="/assets/backend/images/empty-photo.jpg" data-src="/assets/backend/images/empty-photo.jpg" alt="">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 150px; height: 150px;">
                                        @if(old('image', isset($data) ? $data->image : null)!="")
                                            <img src="{{ old('image', isset($data) ? \App\Library\Files::media($data->image) : null) }}">
                                            <input type="hidden" name="image_oldest" value="1">
                                        @endif
                                    </div>
                                    <div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">Chọn ảnh đại diện</span>
                                                <span class="fileinput-exists">Đổi ảnh đại diện</span>
                                                    <input type="file" name="image">
                                            </span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="form-text text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--  File pdf--}}
                    <div class="form-group row">
                        {{-- PDF Upload --}}
                        <div class="col-md-6">
                            <label for="pdf" class="form-label">{{ __('Tài liệu PDF') }}:</label>
                            <div class="input-group">
                                <label class="input-group-text btn btn-primary" for="pdfInput">
                                    <i class="bi bi-file-earmark-pdf"></i> {{ isset($data) && $data->pdf_file ? "Đổi file PDF" : "Chọn file PDF" }}
                                </label>
                                <input type="file" class="form-control d-none" id="pdfInput" name="pdf" accept=".pdf">
                            </div>
                            <div class="mt-2" id="pdfFileName" style="display: {{ isset($data) && $data->pdf_file ? 'block' : 'none' }};">
                                <span class="btn btn-light-primary font-weight-bolder mr-2">
                                    <i class="bi bi-file-earmark"></i>
                                    <a download="{{ isset($data) && isset($data->pdf_file) ? basename($data->pdf_file) : '' }}" href="{{isset($data) && isset($data->pdf_file) ? \App\Library\Files::media($data->pdf_file) : '' }}" id="fileNameText">{{ isset($data) && $data->pdf_file ? basename($data->pdf_file) : '' }}</a>
                                </span>
                                @if (isset($data) && isset($data->pdf_file))
                                    <a href="#"  data-file="{{\App\Library\Files::media($data->pdf_file)}}" class="pdf-link btn btn-success font-weight-bolder ms-2">{{ __('Xem PDF') }}</a>
                                @endif
                            </div>
                            @if ($errors->has('pdf'))
                                <div class="text-danger mt-1">{{ $errors->first('pdf') }}</div>
                            @endif
                        </div>
                    </div>
                    {{--  File pdf--}}
                    <div class="form-group row">
                        <div class="col-md-12">
                            <iframe id="pdfViewer" src="" frameborder="0" width="100%" height="600px"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            Trạng thái <i class="mr-2"></i>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    {{-- status --}}
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <label for="status" class="form-control-label">{{ __('Trạng thái') }}</label>
                            {{Form::select('status',(config('module.'.$module.'.status')??[]) ,old('status', isset($data) ? $data->status : null),array('class'=>'form-control'))}}
                            @if($errors->has('status'))
                                <div class="form-control-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>
                    {{-- created_at --}}
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <label>{{ __('Ngày tạo') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control  datetimepicker-input datetimepicker-default"
                                       name="created_at"
                                       value="{{ old('created_at', isset($data) ? $data->created_at->format('d/m/Y H:i:s') : date('d/m/Y H:i:s')) }}"
                                       placeholder="{{ __('Ngày tạo') }}" autocomplete="off"
                                       data-toggle="datetimepicker">

                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-calendar"></i></span>
                                </div>
                            </div>
                            @if($errors->has('created_at'))
                                <div class="form-control-feedback">{{ $errors->first('created_at') }}</div>
                            @endif
                        </div>
                    </div>
                    {{-- ended_at --}}
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <label>{{ __('Ngày hết hạn') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control  datetimepicker-input datetimepicker-default"
                                       name="ended_at"
                                       @if( isset($data->ended_at) && $data->ended_at!="0000-00-00 00:00:00" )

                                            value="{{ old('expired_at', isset($data->ended_at) ? date('d/m/Y H:i:s', strtotime($data->ended_at)) : "") }}"
                                       @else
                                            value="{{ old('expired_at', "") }}"
                                       @endif
                                       placeholder="{{ __('Ngày hết hạn') }}" autocomplete="off"
                                       data-toggle="datetimepicker">

                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-calendar"></i></span>
                                </div>
                            </div>
                            @if($errors->has('created_at'))
                                <div class="form-control-feedback">{{ $errors->first('created_at') }}</div>
                            @endif
                        </div>
                    </div>
                    {{-- order --}}
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <label for="order">{{ __('Thứ tự') }}</label>
                            <input type="text" name="order" value="{{ old('order', isset($data) ? $data->order : null) }}"
                                   placeholder="{{ __('Thứ tự') }}"
                                   class="form-control {{ $errors->has('order') ? ' is-invalid' : '' }}">
                            @if ($errors->has('order'))
                                <span class="form-text text-danger">{{ $errors->first('order') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}

@endsection

{{-- Styles Section --}}
@section('styles')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.5/css/fileinput.min.css'>
<style>
    .progress{
        background-color: #fff !important;
    }
    .form-attribute{
        border-bottom: 1px solid #e4e6ef;
        padding: 15px 0px;
    }
    /* .content-item-attribute{
        padding-bottom: 15px
    } */
</style>
@endsection
{{-- Scripts Section --}}
@section('scripts')

    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/dompurify/0.8.3/purify.min.js'></script> --}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.4.2/Sortable.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.5/js/fileinput.min.js'></script>
    <script>
        "use strict";
        $(document).ready(function () {
            $('#pdfInput').on('change', function () {
                var fileName = $(this).val().split('\\').pop();
                if (fileName) {
                    $('#fileNameText').text(fileName);
                    $('#pdfFileName').show();
                } else {
                    $('#pdfFileName').hide();
                }
            });
            $('.pdf-link').on('click', function(e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
                var filePath = $(this).data('file'); // Lấy đường dẫn file từ thuộc tính data-file
                $('#pdfViewer').attr('src', filePath).show(); // Đặt src cho iframe và hiển thị nó
            });
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
            $('.ckeditor-source').each(function () {
                var elem_id=$(this).prop('id');
                var height=$(this).data('height');
                height=height!=""?height:150;
                var startupMode= $(this).data('startup-mode');
                if(startupMode=="source"){
                    startupMode="source";
                }
                else{
                    startupMode="wysiwyg";
                }
                CKEDITOR.replace(elem_id, {
                    filebrowserBrowseUrl     : "{{ route('admin.ckfinder_browser') }}?_token={{csrf_token()}}",
                    filebrowserImageBrowseUrl: "{{ route('admin.ckfinder_browser') }}?type=Images&_token={{csrf_token()}}",
                    filebrowserFlashBrowseUrl: "{{ route('admin.ckfinder_browser') }}?type=Flash&_token={{csrf_token()}}",
                    filebrowserUploadUrl     : "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Files&_token={{csrf_token()}}",
                    filebrowserImageUploadUrl: "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Images&_token={{csrf_token()}}",
                    filebrowserFlashUploadUrl: "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Flash&_token={{csrf_token()}}",
                    height:height,
                    startupMode:startupMode,
                } );

            });
            $('.ckeditor-basic').each(function () {
                var elem_id=$(this).prop('id');
                var height=$(this).data('height');
                height=height!=""?height:150;
                CKEDITOR.replace(elem_id, {
                    filebrowserBrowseUrl     : "{{ route('admin.ckfinder_browser') }}",
                    filebrowserImageBrowseUrl: "{{ route('admin.ckfinder_browser') }}?type=Images&_token={{csrf_token()}}",
                    filebrowserFlashBrowseUrl: "{{ route('admin.ckfinder_browser') }}?type=Flash&_token={{csrf_token()}}",
                    filebrowserUploadUrl     : "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Files&_token={{csrf_token()}}",
                    filebrowserImageUploadUrl: "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Images&_token={{csrf_token()}}",
                    filebrowserFlashUploadUrl: "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Flash&_token={{csrf_token()}}",
                    height:height,
                    removeButtons: 'Source',
                } );
            });
            // Image choose item
            $(".ck-popup").click(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.ck-parent');
                var elemThumb = parent.find('.ck-thumb');
                var elemInput = parent.find('.ck-input');
                var elemBtnRemove = parent.find('.ck-btn-remove');
                CKFinder.modal({
                    connectorPath: '{{route('admin.ckfinder_connector')}}',
                    resourceType: 'Images',
                    chooseFiles: true,
                    width: 900,
                    height: 600,
                    onInit: function (finder) {
                        finder.on('files:choose', function (evt) {
                            var file = evt.data.files.first();
                            var url = file.getUrl();
                            elemThumb.attr("src", MEDIA_URL+url);
                            elemInput.val(url);
                        });
                    }
                });
            });
            $(".ck-btn-remove").click(function (e) {
                e.preventDefault();

                var parent = $(this).closest('.ck-parent');

                var elemThumb = parent.find('.ck-thumb');
                var elemInput = parent.find('.ck-input');
                elemThumb.attr("src", "/assets/backend/themes/images/empty-photo.jpg");
                elemInput.val("");
            });
            // Image extenstion choose item
            $(".ck-popup-multiply").click(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.ck-parent');
                var elemBoxSort = parent.find('.sortable');
                var elemInput = parent.find('.image_input_text');
                CKFinder.modal({
                    connectorPath: '{{route('admin.ckfinder_connector')}}',
                    resourceType: 'Images',
                    chooseFiles: true,
                    width: 900,
                    height: 600,
                    onInit: function (finder) {
                        finder.on('files:choose', function (evt) {
                            var allFiles = evt.data.files;

                            var chosenFiles = '';
                            var len = allFiles.length;
                            allFiles.forEach( function( file, i ) {
                                chosenFiles += file.get('url');
                                if (i != len - 1) {
                                    chosenFiles += "|";
                                }

                                elemBoxSort.append(`<div class="image-preview-box">
                                            <img src="${MEDIA_URL+file.get('url')}" alt="" data-input="${file.get( 'url' )}">
                                            <a rel="8" class="btn btn-xs  btn-icon btn-danger btn_delete_image" data-toggle="modal" data-target="#deleteModal"><i class="la la-close"></i></a>
                                        </div>`);
                            });
                            var allImageChoose=parent.find(".image-preview-box img");
                            var allPath = "";
                            var len = allImageChoose.length;
                            allImageChoose.each(function (index, obj) {
                                allPath += $(this).attr('data-input');

                                if (index != len - 1) {
                                    allPath += "|";
                                }
                            });
                            elemInput.val(allPath);

                            //set lại event cho các nút xóa đã được thêm
                            //remove image extension each item
                            $('.btn_delete_image').click(function (e) {

                                var parent = $(this).closest('.ck-parent');
                                var elemInput = parent.find('.image_input_text');
                                $(this).closest('.image-preview-box').remove();
                                var allImageChoose=parent.find(".image-preview-box img");

                                var allPath = "";
                                var len = allImageChoose.length;
                                allImageChoose.each(function (index, obj) {
                                    allPath += $(this).attr('src');
                                    if (index != len - 1) {
                                        allPath += "|";
                                    }
                                });
                                elemInput.val(allPath);
                            });
                            //khoi tao lại sortable sau khi append phần tử mới
                            $('.sortable').sortable().bind('sortupdate', function (e, ui) {

                                var parent = $(this).closest('.ck-parent');
                                var allImageChoose=parent.find(".image-preview-box img");
                                var elemInput = parent.find('.image_input_text');
                                var allPath = "";
                                var len = allImageChoose.length;
                                allImageChoose.each(function (index, obj) {
                                    allPath += $(this).attr('src');

                                    if (index != len - 1) {
                                        allPath += "|";
                                    }
                                });
                                elemInput.val(allPath);
                            });

                        });
                    }
                });
            });
            //remove image extension each item
            $('.btn_delete_image').click(function (e) {
                var parent = $(this).closest('.ck-parent');
                var elemInput = parent.find('.image_input_text');
                $(this).closest('.image-preview-box').remove();
                var allImageChoose=parent.find(".image-preview-box img");
                var allPath = "";
                var len = allImageChoose.length;
                allImageChoose.each(function (index, obj) {
                    allPath += $(this).attr('src');

                    if (index != len - 1) {
                        allPath += "|";
                    }
                });
                elemInput.val(allPath);
            });
            //khoi tao sortable
            $('.sortable').sortable().bind('sortupdate', function (e, ui) {
                var parent = $(this).closest('.ck-parent');
                var allImageChoose=parent.find(".image-preview-box img");
                var elemInput = parent.find('.image_input_text');
                var allPath = "";
                var len = allImageChoose.length;
                allImageChoose.each(function (index, obj) {
                    allPath += $(this).attr('src');

                    if (index != len - 1) {
                        allPath += "|";
                    }
                });
                elemInput.val(allPath);
            });
            //ckfinder for upload file
            $(".ck-popup-file").click(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.ck-parent');
                var elemInput = parent.find('.ck-input');
                var elemBtnRemove = parent.find('.ck-btn-remove');
                CKFinder.modal({
                    connectorPath: '{{route('admin.ckfinder_connector')}}',
                    resourceType: 'Files',
                    chooseFiles: true,
                    width: 900,
                    height: 600,
                    onInit: function (finder) {
                        finder.on('files:choose', function (evt) {
                            var file = evt.data.files.first();
                            var url = file.getUrl();
                            elemInput.val(url);

                        });
                    }
                });
            });
            $(".file-preview-thumbnails").draggable({
                scroll: false,
                axis: "x",
                containment: "parent",
                revert: true,
                helper: "orginal",
                disable: false,
                start: function( event, ui ) {
                    $(ui.item).addClass("active-draggable");
                },
                drag: function( event, ui ) {
                },
                stop:function( event, ui ) {
                    $(ui.item).removeClass("active-draggable");
                }
            });

            $( ".file-preview" ).droppable({
                accept: ".file-preview-thumbnails",
                class: {
                "ui-droppable-active":"ac",
                "ui-droppable-hover":"hv"
            },
            acivate: function( event, ui ) {
                $(this).css('background','red');
            },
            over: function( event, ui ) {
                $(this).css('background','yellow');
            },
            out: function( event, ui ) {
                $(this).css('background','blue');
            },
            drop: function( event, ui ) {
                $(this).css('background','white');
            },
            deactivate: function( event, ui ) {
                $(ui.item).css('background','green');
            },
            });

        });

        $('body').on('click','.btn_attribute_delete',function(){
            var attribute = $(this).data('attribute');
            var prd = $(this).data('prd');
            $('#attribute_'+attribute+' .content-item-attribute-'+prd).remove();
        })
        $('body').on('click','.btn_add_attribute',function(){
            var attribute = $(this).data('attribute');
            var title = $(this).data('title');
            var id_rand = Math.floor(Math.random() * (9999 - 1000)) + 1000;
            var html = '<div class="form-group row content-item-attribute-'+id_rand+'"><label class="col-2 col-form-label">'+title+'</label><div class="col-8"><input class="form-control" type="text" placeholder="Vui lòng nhập thuộc tính.." name="attribute['+attribute+'][]" value=""></div><div div="" class="col-2 btn_attribute_delete" style="cursor: pointer" data-prd="'+id_rand+'" data-attribute="'+attribute+'"><i class="icon-2x text-dark-50 flaticon-delete"></i></div></div>';
            $('#attribute_'+attribute+' .content-attribute').append(html);
        });
        $('body').on('click','.btn_add_promotion',function(){
            var id_rand = Math.floor(Math.random() * (9999 - 1000)) + 1000;
            var html = '<div class="form-group row item-promotion-'+id_rand+'"><div class="col-10"><input class="form-control" type="text" placeholder="Vui lòng nhập khuyến mại" name="promotion[]" value=""></div><div div="" class="col-2 btn_promotion_delete"  data-promotion="'+id_rand+'" style="cursor: pointer"><i class="icon-2x text-dark-50 flaticon-delete"></i></div></div>';
            $('#promotion .content-item-promotion').append(html);
        })
        $('body').on('click','.btn_promotion_delete',function(){
            var promotion = $(this).data('promotion');
            if(promotion === undefined){
                return false;
            }
            $('#promotion .content-item-promotion .item-promotion-'+promotion).remove();
        })
    </script>

@endsection


