@extends('frontend.layouts.master')
@section('content')
<div class="row mx-0 c-p-8">
    <div class="col-lg-8">
        <div class="table-responsive" >
            <p   class=" t-body-1 fz-16 fw-600 lh-24">{{$data->title}}</p>
            <table class="table table-hover table-custom-res">
                <thead>

                </thead>
                <tbody>
                <tr>
                    <td class="col-4 fw-600">Số ký hiệu văn bản</td>
                    <td>{{$data->title}}</td>

                </tr>
                <tr>
                    <td class="col-4 fw-600">Ngày ban hành</td>
                    <td>{{isset($data) ? $data->created_at->format('d/m/Y') : ''}}</td>
                </tr>
                <tr>
                    <td class="col-4 fw-600">Ngày hiệu lực</td>
                    <td>{{isset($data) ? $data->created_at->format('d/m/Y') : ''}}</td>
                </tr>
                <tr>
                    <td class="col-4 fw-600">Trích yếu nội dung</td>
                    <td>{!! $data->description !!}</td>
                </tr>
                <tr>
                    <td class="col-4 fw-600">Tài liệu đính kèm</td>
                    <td>
                        <a download="{{ isset($data) && isset($data->pdf_file) ? basename($data->pdf_file) : '' }}" href="{{isset($data) && isset($data->pdf_file) ? \App\Library\Files::media($data->pdf_file) : '' }}" id="fileNameText">{{ isset($data) && $data->pdf_file ? basename($data->pdf_file) : '' }}</a>
                        <br>
                        <br>
                         @if (isset($data) && isset($data->pdf_file))
                            <a href="#"  data-file="{{\App\Library\Files::media($data->pdf_file)}}" class="pdf-link btn btn-danger font-weight-bolder ms-2">{{ __('Xem PDF') }}</a>
                        @endif
                    </td>

                </tr>
                </tbody>
            </table>
            {{--  File pdf--}}
            <div class="form-group row">
                <div class="col-md-12">
                    <iframe id="pdfViewer" src="" frameborder="0" width="100%" height="600px"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 c-mt-lg-8 c-px-lg-4">
        <!-- văn bản mới-->
        <div class="article-default c-mb-12">
            <div class="article-header w-100">
                <a href="">
                    Loại văn bản
                </a>
            </div>
            <div class="article-content c-mt-12">

                <div class="article-content-item c-px-12">
                    <div class="article-content-arrow c-mb-6">
                        Công văn (0)
                    </div>
                    <div class="article-content-arrow c-mb-6">
                        Công văn (0)
                    </div>
                    <div class="article-content-arrow c-mb-6">
                        Công văn (0)
                    </div>
                </div>
            </div>
        </div>
        <div class="article-default c-mb-12">
            <div class="article-header w-100">
                <a href="">
                    Loại văn bản
                </a>
            </div>
            <div class="article-content c-mt-12">

                <div class="article-content-item c-px-12">
                    <div class="article-content-arrow c-mb-6">
                        Công văn (0)
                    </div>
                    <div class="article-content-arrow c-mb-6">
                        Công văn (0)
                    </div>
                    <div class="article-content-arrow c-mb-6">
                        Công văn (0)
                    </div>
                </div>
            </div>
        </div>
        <div class="article-default c-mb-12">
            <div class="article-header w-100">
                <a href="">
                    Loại văn bản
                </a>
            </div>
            <div class="article-content c-mt-12">

                <div class="article-content-item c-px-12">
                    <div class="article-content-arrow c-mb-6">
                        Công văn (0)
                    </div>
                    <div class="article-content-arrow c-mb-6">
                        Công văn (0)
                    </div>
                    <div class="article-content-arrow c-mb-6">
                        Công văn (0)
                    </div>
                </div>
            </div>
        </div>

        <div class="swiper-ads">
            <div class="swiper-wrapper" >
                <div class="swiper-slide" >
                    <a href="#">
                        <img src="image/ads1.jpg" loading="lazy">
                    </a>
                </div>
                <div class="swiper-slide" >
                    <a href="#">
                        <img src="image/ads2.jpg" loading="lazy">
                    </a>
                </div>

            </div>
        </div>
        <div class="ads-container mt-2">
            <div class="steering-header">
                <a href="" class="c-pl-30 fw-600 text-uppercase lh-26 text-white"> Trung tâm Điều dưỡng người có công </a>
            </div>
            <div class="ads-content">
                <iframe  src="https://www.youtube.com/embed/f9P7_qWrf38?si=BslFHhVuzRChB7Fj" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
        <div class="ads-container mt-2">
            <div class="ads-content">
                <img src="https://storage-vnportal.vnpt.vn/sla-ubnd/5347/bannercacdonvi/banner-1-.jpg" alt="">
            </div>
        </div>
        <div class="ads-container mt-2">
            <div class="steering-header">
                <a href="" class="c-pl-30 fw-600 text-uppercase lh-26 text-white"> Thống kê truy cập </a>
            </div>
            <div class="ads-content c-p-10">
                <span>Đang online: 1</span>
                <br>
                <span>Hôm nay: 125</span>
                <br>
                <span>Tất cả: 65656</span>
                <br>
            </div>
        </div>
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
        <div class="ads-container mt-2">
            <div class="ads-content">
                <img src="https://storage-vnportal.vnpt.vn/sla-ubnd/5347/bannercacdonvi/banner-1-.jpg" alt="">
            </div>
        </div>
        <div class="ads-container mt-2">
            <div class="ads-content">
                <img src="https://storage-vnportal.vnpt.vn/sla-ubnd/5347/bannercacdonvi/banner-1-.jpg" alt="">
            </div>
        </div>
        <div class="ads-container mt-2">
            <div class="ads-content">
                <img src="https://storage-vnportal.vnpt.vn/sla-ubnd/5347/bannercacdonvi/banner-1-.jpg" alt="">
            </div>
        </div>

    </div>
</div>
<script>
    $('.pdf-link').on('click', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        var filePath = $(this).data('file'); // Lấy đường dẫn file từ thuộc tính data-file
        $('#pdfViewer').attr('src', filePath).show(); // Đặt src cho iframe và hiển thị nó
    });
</script>
@endsection
