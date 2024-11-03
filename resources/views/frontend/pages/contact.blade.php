@extends('frontend.layouts.master')
@section('content')
    <div class="row mx-0 c-p-8">
        <div class="col-lg-8">
            <div class="document-form">
                <form action="{{ route('lien-he.store') }}" method="POST">
                    @csrf

                    <h2 class="document-header t-cap-3 fz-20">Liên hệ </h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div class="c-mb-4">{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="document-form-search c-py-8">
                        <div class="col-md-12">
                            <div class="c-mb-12">
                                <label class="c-mb-4">Chuyên mục <span class="text-danger">*</span></label>
                                <select type="text" name="type" class="form-control ">
                                    <option value="1" >Hỏi đáp</option>
                                    <option value="2" >Phản ánh</option>
                                </select>
                            </div>
                            <div class="c-mb-12">
                                <label class="c-mb-4">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control " placeholder="Nội dung tìm kiếm">

                            </div>

                            <div class="c-mb-12">
                                <label class="c-mb-4">Nội dung câu hỏi <span class="text-danger">*</span></label>
                                <textarea type="text" name="content" class="form-control " placeholder="Nội dung câu hỏi"></textarea>

                            </div>
                            <div class="c-mb-12">
                                <label class="c-mb-4">Người hỏi <span class="text-danger">*</span></label>
                                <input type="text" name="author" class="form-control " placeholder="Người hỏi">

                            </div>
                            <div class="c-mb-12">
                                <label class="c-mb-4">Địa chỉ <span class="text-danger">*</span></label>
                                <input type="text" name="address" class="form-control " placeholder="Địa chỉ">

                            </div>
                            <div class="c-mb-12">
                                <label class="c-mb-4">Điện thoại <span class="text-danger">*</span></label>
                                <input type="number" name="phone" class="form-control " placeholder="Điện thoại">

                            </div>
                            <div class="c-mb-12">
                                <label class="c-mb-4">Email <span class="text-danger">*</span></label>
                                <input type="text" name="email" class="form-control " placeholder="Email">

                            </div>

                        </div>
                        <div class="col-md-12 item_buy_form_search c-mt-16">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-danger" style="position: relative">
                                            Gửi câu hỏi
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
