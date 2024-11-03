@extends('frontend.layouts.master')
@section('content')
<div class="row mx-0 c-p-8">
    <div class="col-lg-8">
        <div class="document-form">
            <form action="">
                <h2 class="document-header t-cap-3 fz-20">{{$data->title}} </h2>
                <div class="document-form-search c-py-8">
                    <div class="col-md-12">
                        <div class="c-mb-12">
                            <label class="c-mb-4">Nội dung tìm kiếm</label>
                            <input type="text" name="title" class="form-control " placeholder="Nội dung tìm kiếm">

                        </div>
                        <div class="c-mb-12">
                            <label class="c-mb-4">Loại văn bản</label>
                            <select type="text" name="group" class="form-control ">
                                <option value="">-- Toàn bộ --</option>
                                @foreach($data_category as $category)
                                    <option value="{{$category->id}}" {{ request()->get('group') == $category->id ? 'selected' : '' }}>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="c-mb-12">
                            <label class="c-mb-4">Lĩnh vực</label>
                            <select type="text" name="field" class="form-control ">
                                <option value="">-- Toàn bộ --</option>
                                @foreach($data_field as $field)
                                    <option value="{{$field->id}}" {{ request()->get('field') == $field->id ? 'selected' : '' }}>{{$field->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="c-mb-12">
                            <label class="c-mb-4">Cơ quan ban hành:</label>
                            <select type="text" name="agency" class="form-control ">
                                <option value="">-- Toàn bộ --</option>
                                @foreach($data_agency as $agency)
                                    <option value="{{$agency->id}}" {{ request()->get('agency') == $agency->id ? 'selected' : '' }}>{{$agency->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 item_buy_form_search c-mt-16">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-danger" style="position: relative">
                                        Tìm kiếm
                                    </button>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-all c-ml-12" style="position: relative">
                                        Tất cả
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div id="data_pay_account_history" style="position: relative">
                <div class="body-box-loadding result-amount-loadding" style="position: absolute;top: 100%;left: 50%">
                    <div class="d-flex justify-content-center">
                        <span class="pulser"></span>
                    </div>
                </div>
                @include('frontend.pages.documents.func.load_item')

            </div>
        </div>


    </div>
    <div class="col-lg-4 c-mt-lg-8 c-px-lg-4">
        <!-- văn bản mới-->
        {!! widget('frontend.widget._article') !!}

        {!! widget('frontend.widget._section_widget_slide_ads') !!}
        {!! widget('frontend.widget._section_widget_iframe_right_1') !!}

        <div class="ads-container mt-2">
            <div class="steering-header">
                <a href="" class="c-pl-30 fw-600 text-uppercase lh-26 text-white"> Liên kết website </a>
            </div>
            <div class="ads-content c-p-10">
                <select name="" id="">
                    <option value="">6565</option>
                    <option value="">6565</option>
                    <option value="">6565</option>
                    <option value="">6565</option>
                    <option value="">6565</option>
                </select>
            </div>
        </div>
        {!! widget('frontend.widget._section_widget_iframe_right_2') !!}


    </div>
</div>
<script>
    $(document).ready(function() {
        $('.btn-all').on('click', function(e) {
            // Lấy URL gốc của trang mà không có các tham số truy vấn
            const originalURL = window.location.origin + window.location.pathname;

            // Chuyển hướng đến URL mới
            window.location.href = originalURL;
        });
    });
</script>
@endsection
