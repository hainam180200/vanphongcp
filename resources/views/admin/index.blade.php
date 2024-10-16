{{-- Extends layout --}}
@extends('admin._layouts.master')

{{-- Content --}}
@section('content')
@role('admin')
@php 
$year = Carbon\Carbon::now()->year;
$month = Carbon\Carbon::now()->month;
@endphp
<div class="row">
    <div class="col-xl-6">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Sản phẩm được xem nhiều nhất</h3>
                <hr>
            </div>
            <div class="card-body pt-2" style="max-height:500px;overflow:auto">
                @foreach ($product as $item)
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="background-image: url('{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}');height:110px"></div>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 mr-2">
                            <a href="/{{isset($item->url) ? $item->url : $item->slug}}" target="_blank" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">{{\Str::limit($item->title,40)}}</a>
                            {{-- <span class="text-muted font-weight-bold">Visually stunning</span> --}}
                        </div>
                        <div class="d-flex align-items-center mt-lg-0 mt-3">
                            <div class="mr-6">
                                <i class="la la-eye mr-1 text-warning font-size-lg"></i>
                                <span class="text-dark-75 font-weight-bolder">{{\App\Library\Helpers::NumberFormatShort($item->totalviews)}}</span>
                            </div>
                            <a href="/{{isset($item->url) ? $item->url : $item->slug}}" target="_blank" class="btn btn-icon btn-light btn-sm">
                                <span class="svg-icon svg-icon-success">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Bài viết được xem nhiều nhất</h3>
                <hr>
            </div>
            <div class="card-body pt-2" style="max-height:500px;overflow:auto">
                @foreach ($article as $item)
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="background-image: url('{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}');height:110px"></div>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 mr-2">
                            <a href="/blog/{{isset($item->url) ? $item->url : $item->slug}}" target="_blank" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">{{\Str::limit($item->title,40)}}</a>
                            {{-- <span class="text-muted font-weight-bold">Visually stunning</span> --}}
                        </div>
                        <div class="d-flex align-items-center mt-lg-0 mt-3">
                            <div class="mr-6">
                                <i class="la la-eye mr-1 text-warning font-size-lg"></i>
                                <span class="text-dark-75 font-weight-bolder">{{\App\Library\Helpers::NumberFormatShort($item->totalviews)}}</span>
                            </div>
                            <a href="/blog/{{isset($item->url) ? $item->url : $item->slug}}" target="_blank" class="btn btn-icon btn-light btn-sm">
                                <span class="svg-icon svg-icon-success">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3>Thống kê đơn hàng</h3>
                </div>
                <div class="card-toolbar">
                    <form action="" method="POST" class="d-flex justify-content-center">
                        {{ csrf_field() }}
                        <div class="example-tools justify-content-center mr-3">
                            <select class="form-control form-control-sm" name="year" id="order_year">
                                <option value="{{$year}}">{{$year}}</option>
                                <option value="{{$year - 1}}">{{$year - 1}}</option>
                                <option value="{{$year - 2}}">{{$year - 2}}</option>
                                <option value="{{$year - 3}}">{{$year - 3}}</option>
                                <option value="{{$year - 4}}">{{$year - 4}}</option>
                            </select>
                        </div>
                        <div class="example-tools justify-content-center">
                            <select class="form-control form-control-sm" name="month" id="order_month">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{$i}}" @if ($i == $month)
                                        selected
                                    @endif
                                    > Tháng {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="example-tools">
                            <button type="submit" class="btn btn-light-primary font-weight-bold ml-2 form-control form-control-sm">Xuất</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div id="order"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3>Doanh thu</h3>
                </div>
                <div class="card-toolbar">
                    <form action="" method="POST" class="d-flex justify-content-center">
                        {{ csrf_field() }}
                        <div class="example-tools justify-content-center mr-3">
                            <select class="form-control form-control-sm" name="year" id="order_price_year">
                                <option value="{{$year}}">{{$year}}</option>
                                <option value="{{$year - 1}}">{{$year - 1}}</option>
                                <option value="{{$year - 2}}">{{$year - 2}}</option>
                                <option value="{{$year - 3}}">{{$year - 3}}</option>
                                <option value="{{$year - 4}}">{{$year - 4}}</option>
                            </select>
                        </div>
                        <div class="example-tools justify-content-center">
                            <select class="form-control form-control-sm" name="month" id="order_price_month">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{$i}}" @if ($i == $month)
                                        selected
                                    @endif
                                    > Tháng {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="example-tools">
                            <button type="submit" class="btn btn-light-primary font-weight-bold ml-2 form-control form-control-sm">Xuất</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div id="order_price"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3>Tăng trưởng thành viên</h3>
                </div>
                <div class="card-toolbar">
                    <form action="" method="POST" class="d-flex justify-content-center">
                        <div class="example-tools">
                            <select class="form-control form-control-sm" name="year" id="growth_user_year">
                                <option value="{{$year}}">{{$year}}</option>
                                <option value="{{$year - 1}}">{{$year - 1}}</option>
                                <option value="{{$year - 2}}">{{$year - 2}}</option>
                                <option value="{{$year - 3}}">{{$year - 3}}</option>
                                <option value="{{$year - 4}}">{{$year - 4}}</option>
                            </select>
                        </div>
                        {{-- <div class="example-tools">
                            <button type="submit" class="btn btn-light-primary font-weight-bold ml-2 form-control form-control-sm">Xuất</button>
                        </div> --}}
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div id="growth_user"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')

@endsection
{{-- Scripts Section --}}
@section('scripts')
    <script>
        const primary = '#6993FF';
        const success = '#1BC5BD';
        const info = '#8950FC';
        const warning = '#FFA800';
        const danger = '#F64E60';
        const drak = '#181c32';
        var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };
        // setup biểu đồ tăng trường thành viên
        var ChartsGrowthUser = function () {
            var _user = function (categories,growth) {
                const apexChart = "#growth_user";
                var options = {
                    series: [{
                        name: "Thành viên",
                        data: growth
                    }],
                    chart: {
                        height: 340,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: { 	
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'],
                            opacity: 0.5
                        },
                    },
                    xaxis: {
                        categories:categories,
                    },
                    colors: [primary]
                };
                var chart = new ApexCharts(document.querySelector(apexChart), options);
                chart.render();
            }
            return {
                init: function (categories,growth) {
                    _user(categories,growth);
                }
            };
        }();
        // gọi data tăng trưởng thành viên
        function GrowthUser(year){
            $.ajax({
                type: "GET",
                url: "{{route('admin.growth.user')}}",
                data:{
                    year:year
                },
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    if(data.success == true){
                        var categories = data.data['growth_month'];
                        categories = $.map(categories, function(value, index) {
                            return [value];
                        });
                        var growth = data.data['growth_user'];
                        growth = $.map(growth, function(value, index) {
                            return [value];
                        });
                        ChartsGrowthUser.init(categories,growth);
                    }
                    else{
                        alert('Có lỗi xảy ra vui lòng liên hệ Admin để xử lý');
                        return false;
                    }
                },
                error: function (data) {
                    alert('Có lỗi xảy ra vui lòng liên hệ Admin để xử lý');
                        return false;
                },
                complete: function (data) {
                    
                }
            });
        }
         // setup biểu đồ thống kê đơn hàng
         var ChartsOrder = function () {
            var order = function (growth_0,growth_1,growth_2,growth_3,growth_4,growth_day) {
            const apexChart = "#order";
            var options = {
                series: [
                    {
                        name: 'Đã hủy',
                        data: growth_0
                    },
                    {
                        name: 'Đã xử lý (Đang chờ giao hàng)',
                        data: growth_1
                    },
                    {
                        name: 'Đang chờ xử lý',
                        data: growth_2
                    },
                    {
                        name: 'Đang giao hàng',
                        data: growth_3
                    },
                    {
                        name: 'Đơn hàng đã thành công',
                        data: growth_4
                    },
                ],
                chart: {
                    height: 350,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: growth_day
                },
                colors: [danger,drak,primary,warning,success]
            };
            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }
        return {
                init: function (growth_0,growth_1,growth_2,growth_3,growth_4,growth_day) {
                    order(growth_0,growth_1,growth_2,growth_3,growth_4,growth_day);
                }
            };
        }();
        function Order(year,month){
            $.ajax({
                type: "GET",
                url: "{{route('admin.growth.order')}}",
                data:{
                    year:year,
                    month:month
                },
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    if(data.success == true){
                        var growth_0 = data.data.growth_0;
                        growth_0 = $.map(growth_0, function(value, index) {
                            return [value];
                        });
                        var growth_1 = data.data.growth_1;
                        growth_1 = $.map(growth_1, function(value, index) {
                            return [value];
                        });
                        var growth_2 = data.data.growth_2;
                        growth_2 = $.map(growth_2, function(value, index) {
                            return [value];
                        });
                        var growth_3 = data.data.growth_3;
                        growth_3 = $.map(growth_3, function(value, index) {
                            return [value];
                        });
                        var growth_4 = data.data.growth_4;
                        growth_4 = $.map(growth_4, function(value, index) {
                            return [value];
                        });
                        var growth_day = data.data.growth_day;
                        growth_day = $.map(growth_day, function(value, index) {
                            return [value];
                        });
                        ChartsOrder.init(growth_0,growth_1,growth_2,growth_3,growth_4,growth_day);
                    }
                    else{
                        alert('Có lỗi xảy ra vui lòng liên hệ Admin để xử lý');
                        return false;
                    }
                },
                error: function (data) {
                    alert('Có lỗi xảy ra vui lòng liên hệ Admin để xử lý');
                        return false;
                },
                complete: function (data) {
                    
                }
            });
        }
         // setup biểu đồ doanh thu
         var ChartsOrderPrice = function () {
            var order_price = function (growth,growth_day) {
            const apexChart = "#order_price";
            var options = {
                series: [
                    {
                        name: 'Doanh thu',
                        data: growth
                    },
                ],
                chart: {
                    height: 350,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: growth_day
                },
                colors: [success]
            };
            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }
        return {
                init: function (growth_0,growth_1,growth_2,growth_3,growth_4,growth_day) {
                    order_price(growth_0,growth_1,growth_2,growth_3,growth_4,growth_day);
                }
            };
        }();
        function Order_Price(year,month){
            $.ajax({
                type: "GET",
                url: "{{route('admin.growth.order-price')}}",
                data:{
                    year:year,
                    month:month
                },
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    if(data.success == true){
                        var growth = data.data.growth;
                        growth = $.map(growth, function(value, index) {
                            return [value];
                        });
                        var growth_day = data.data.growth_day;
                        growth_day = $.map(growth_day, function(value, index) {
                            return [value];
                        });
                        ChartsOrderPrice.init(growth,growth_day);
                    }
                    else{
                        alert('Có lỗi xảy ra vui lòng liên hệ Admin để xử lý');
                        return false;
                    }
                },
                error: function (data) {
                    alert('Có lỗi xảy ra vui lòng liên hệ Admin để xử lý');
                        return false;
                },
                complete: function (data) {
                    
                }
            });
        }
        jQuery(document).ready(function () {
            GrowthUser();
            $('body').on('change','#growth_user_year',function(){
                year = $(this).val();
                $("#growth_user").fadeOut(700,function(){
                    $( "#growth_user" ).load(window.location.href + " #growth_user" );
                    GrowthUser(Number(year))
                    setTimeout(function(){
                        $("#growth_user").fadeIn(700);
                     }, 2000);
                });
            })
            Order();
            $('body').on('change','#order_year',function(){
                year = $(this).val();
                month = $('#order__month').val();
                $("#order").fadeOut(700,function(){
                    $( "#order" ).load(window.location.href + " #order" );
                    Order(Number(year),Number(month))
                    setTimeout(function(){
                        $("#order").fadeIn(700);
                     }, 4000);
                });
            })
            $('body').on('change','#order_month',function(){
                month = $(this).val();
                year = $('#order_year').val();
                $("#v").fadeOut(700,function(){
                    $( "#v" ).load(window.location.href + " #order" );
                    Order(Number(year),Number(month))
                    setTimeout(function(){
                        $("#order").fadeIn(700);
                    }, 4000);
                });
            })
            Order_Price();
            $('body').on('change','#order_price_year',function(){
                year = $(this).val();
                month = $('#order_price__month').val();
                $("#order_price").fadeOut(700,function(){
                    $( "#order_price" ).load(window.location.href + " #order_price" );
                    Order_Price(Number(year),Number(month))
                    setTimeout(function(){
                        $("#order_price").fadeIn(700);
                     }, 4000);
                });
            })
            $('body').on('change','#order_price_month',function(){
                month = $(this).val();
                year = $('#order_price_year').val();
                $("#order_price").fadeOut(700,function(){
                    $( "#order_price" ).load(window.location.href + " #order_price" );
                    Order_Price(Number(year),Number(month))
                    setTimeout(function(){
                        $("#order_price").fadeIn(700);
                    }, 4000);
                });
            })
        });
    </script>


@endsection
@endrole