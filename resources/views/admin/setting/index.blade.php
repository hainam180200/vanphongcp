{{-- Extends layout --}}
@extends('admin._layouts.master')

@section('action_area')
    <div class="d-flex align-items-center text-right">
        <div class="dropdown dropdown-inline">
            <a href="#" class="btn btn-secondary btn-icon mr-2" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <i class="flaticon-more-v2"></i>
            </a>
            {{-- <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                <!--begin::Navigation-->
                <ul class="navi navi-hover">

                    <li class="navi-separator mb-3 opacity-70"></li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <i class="fas fa-upload mr-3"></i><span class="menu-text">Nhập từ file Excel</span>

                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-text">
                                <span
                                    class="label label-xl label-inline label-light-danger">Partner</span>
                            </span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-text">
                                <span
                                    class="label label-xl label-inline label-light-warning">Suplier</span>
                            </span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-text">
                                <span
                                    class="label label-xl label-inline label-light-primary">Member</span>
                            </span>
                        </a>
                    </li>


                </ul>
                <!--end::Navigation-->
            </div> --}}
        </div>

        <div class="btn-group">
            <div class="btn-group">
                <button type="button" class="btn btn-success font-weight-bolder btn-submit-custom" data-form="formMain">
                    <i class="ki ki-check icon-sm"></i>
                    {{__('Cập nhật')}}
                </button>


            </div>
        </div>
    </div>
@endsection

{{-- Content --}}
@section('content')
    <form action="" id="formMain" method="post" class="form" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom " id="kt_page_sticky_card">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">

                        {{__($page_breadcrumbs[0]['title'])}} <i class="mr-2"></i>

                    </h3>
                </div>
                <div class="card-toolbar"></div>
            </div>

            <div class="card-body">

                <ul class="nav nav-tabs " role="tablist">

                    @if(!empty(config('setting_fields', [])) )
                        @foreach(config('setting_fields') as $section => $fields)
                            <li class="nav-item">
                                <a class="nav-link {{Arr::get($fields, 'class')}}" data-toggle="tab"
                                   href="#{{$section}}" role="tab" aria-selected="true">
                                    <span class="nav-icon">
										<i class="{{ Arr::get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>
									</span>
                                    <span class="nav-text">{{ $fields['title'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>

                <div class="tab-content" style="margin-top: 25px;">
                    @if(!empty(config('setting_fields', [])) )

                        @foreach(config('setting_fields') as $section => $fields)
                            <div class="tab-pane {{Arr::get($fields, 'class')}}" id="{{$section}}" role="tabpanel">

                                @foreach($fields['elements'] as $field)
                                    @includeIf('admin.setting.fields.' . $field['type'] )
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>

    </form>

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection
{{-- Scripts Section --}}
@section('scripts')
    <script>


        $(document).ready(function () {

            $('.btn-submit-custom').click(function (e) {
                e.preventDefault();
                var btn = this;
                $(".btn-submit-custom").each(function (index, value) {
                    KTUtil.btnWait(this, "spinner spinner-right spinner-white pr-15", '{{__('Chờ xử lý')}}', true);
                });
                $('.btn-submit-dropdown').prop('disabled', true);
                $('#submit-close').val($(btn).data('submit-close'));
                var formSubmit = $('#' + $(btn).data('form'));
                formSubmit.submit();
            });

            // $('.btn-submit-custom').click(function (e) {
            //     e.preventDefault();
            //     for (instance in CKEDITOR.instances) {
            //         CKEDITOR.instances[instance].updateElement();
            //     }

            //     var btn = this;
            //     KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", '{{__('Chờ xử lý')}}', true);

            //     var formSubmit = $('#' + $(btn).data('form'));
            //     var url = formSubmit.attr('action');
            //     $.ajax({
            //         type: "POST",
            //         url: url,
            //         data: formSubmit.serialize(), // serializes the form's elements.
            //         beforeSend: function (xhr) {

            //         },
            //         success: function (data) {
            //             if (data.success) {
            //                 if (data.redirect + "" != "") {
            //                     location.href = data.redirect;
            //                 }
            //                 toast('{{__('Cập nhật thành công')}}');
            //             } else {
            //                 toast('{{__('Cập nhật thất bại.Vui lòng thử lại')}}', 'error');
            //             }
            //         },
            //         error: function (data) {
            //             toast('{{__('Cập nhật thất bại.Vui lòng thử lại')}}', 'error');
            //         },
            //         complete: function (data) {
            //             KTUtil.btnRelease(btn);
            //         }
            //     });

            // });

        });
    </script>

@endsection
