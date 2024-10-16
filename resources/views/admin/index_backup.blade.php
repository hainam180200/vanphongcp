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
    <div class="col-lg-6">
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
    <div class="col-lg-6">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3>Tăng trưởng Idol</h3>
                </div>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <select class="form-control form-control-sm" name="year" id="growth_idol_year">
                            <option value="{{$year}}">{{$year}}</option>
                            <option value="{{$year - 1}}">{{$year - 1}}</option>
                            <option value="{{$year - 2}}">{{$year - 2}}</option>
                            <option value="{{$year - 3}}">{{$year - 3}}</option>
                            <option value="{{$year - 4}}">{{$year - 4}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="growth_idol"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3>Phân loại thành viên</h3>
                </div>
            </div>
            <div class="card-body">
                <div id="classify_user" class="d-flex justify-content-center"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3>Thống kê nạp tiền qua ngân hàng</h3>
                </div>
                <div class="card-toolbar">
                    <form action="{{route('admin.growth.export.topup-bank')}}" method="POST" class="d-flex justify-content-center">
                        {{ csrf_field() }}
                        <div class="example-tools justify-content-center mr-3">
                            <select class="form-control form-control-sm" name="year" id="topup_bank_year">
                                <option value="{{$year}}">{{$year}}</option>
                                <option value="{{$year - 1}}">{{$year - 1}}</option>
                                <option value="{{$year - 2}}">{{$year - 2}}</option>
                                <option value="{{$year - 3}}">{{$year - 3}}</option>
                                <option value="{{$year - 4}}">{{$year - 4}}</option>
                            </select>
                        </div>
                        <div class="example-tools justify-content-center">
                            <select class="form-control form-control-sm" name="month" id="topup_bank_month">
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
                <div id="topup_bank"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3>Thống kê nạp thẻ</h3>
                </div>
                <div class="card-toolbar">
                    <form action="{{route('admin.growth.export.charge')}}" method="POST" class="d-flex justify-content-center">
                        {{ csrf_field() }}
                        <div class="example-tools justify-content-center mr-3">
                            <select class="form-control form-control-sm" name="year" id="topup_card_year">
                                <option value="{{$year}}">{{$year}}</option>
                                <option value="{{$year - 1}}">{{$year - 1}}</option>
                                <option value="{{$year - 2}}">{{$year - 2}}</option>
                                <option value="{{$year - 3}}">{{$year - 3}}</option>
                                <option value="{{$year - 4}}">{{$year - 4}}</option>
                            </select>
                        </div>
                        <div class="example-tools justify-content-center">
                            <select class="form-control form-control-sm" name="month" id="topup_card_month">
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
                <div id="topup_card"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3>Thống kê mua thẻ</h3>
                </div>
                <div class="card-toolbar">
                    <form action="{{route('admin.growth.export.store-card')}}" method="POST" class="d-flex justify-content-center">
                        {{ csrf_field() }}
                        <div class="example-tools justify-content-center mr-3">
                            <select class="form-control form-control-sm" name="year" id="store_card_year">
                                <option value="{{$year}}">{{$year}}</option>
                                <option value="{{$year - 1}}">{{$year - 1}}</option>
                                <option value="{{$year - 2}}">{{$year - 2}}</option>
                                <option value="{{$year - 3}}">{{$year - 3}}</option>
                                <option value="{{$year - 4}}">{{$year - 4}}</option>
                            </select>
                        </div>
                        <div class="example-tools justify-content-center">
                            <select class="form-control form-control-sm" name="month" id="store_card_month">
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
                <div id="store_card"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3>Thống kê donate</h3>
                </div>
                <div class="card-toolbar">
                    <form action="{{route('admin.growth.export.donate')}}" method="POST" class="d-flex justify-content-center">
                        {{ csrf_field() }}
                        <div class="example-tools justify-content-center mr-3">
                            <select class="form-control form-control-sm" name="year" id="donate_year">
                                <option value="{{$year}}">{{$year}}</option>
                                <option value="{{$year - 1}}">{{$year - 1}}</option>
                                <option value="{{$year - 2}}">{{$year - 2}}</option>
                                <option value="{{$year - 3}}">{{$year - 3}}</option>
                                <option value="{{$year - 4}}">{{$year - 4}}</option>
                            </select>
                        </div>
                        <div class="example-tools justify-content-center">
                            <select class="form-control form-control-sm" name="month" id="donate_month">
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
                <div id="chart_donate"></div>
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
        var ChartsGrowthIdol = function () {
            var _idol = function (categories,growth) {
                const apexChart = "#growth_idol";
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
                    colors: [info]
                };
                var chart = new ApexCharts(document.querySelector(apexChart), options);
                chart.render();
            }
            return {
                init: function (categories,growth) {
                    _idol(categories,growth);
                }
            };
        }();
        // gọi data tăng trưởng idol
        function GrowthIdol(year){
            $.ajax({
                type: "GET",
                url: "{{route('admin.growth.idol')}}",
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
                        ChartsGrowthIdol.init(categories,growth);
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
        // setup biểu đồ thống kê thành viên
        var ChartsClassifyhUser = function () {
            var classify_user = function (idol,pedding_idol,user,user_block,user_qtv) {
            const apexChart = "#classify_user";
            var options = {
                series: [idol,pedding_idol,user,user_block,user_qtv],
                chart: {
                    width: 555,
                    type: 'pie',
                },
                labels: ['Idol', 'Chờ duyệt Idol', 'Thành viên', 'Thành viên bị khóa', 'QTV'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 350
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                colors: [primary, warning ,success, danger, info]
            };
            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
	    }
        return {
                init: function (idol,pedding_idol,user,user_block,user_qtv) {
                    classify_user(idol,pedding_idol,user,user_block,user_qtv);
                }
            };
        }();
          // gọi data thống kê thành viên
        function ClassifyUser(){
            $.ajax({
                type: "GET",
                url: "{{route('admin.classify.user')}}",
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    if(data.success == true){
                        var idol = data.data.idol;
                        var pedding_idol = data.data.pedding_idol;
                        var user = data.data.user;
                        var user_block = data.data.user_block;
                        var user_qtv = data.data.user_qtv;
                        ChartsClassifyhUser.init(idol,pedding_idol,user,user_block,user_qtv)
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
        //setup biểu đồ nạp thẻ
        var ChartsTopupCard = function () {
            var topup_card = function (growth_card_fail,growth_card_susscess,growth_card_pendding,growth_day) {
            const apexChart = "#topup_card";
            var options = {
                series: [
                    {
                        name: 'Thẻ sai',
                        data: growth_card_fail
                    },
                    {
                        name: 'Thẻ đúng',
                        data: growth_card_susscess
                    },
                    {
                        name: 'Đang chờ',
                        data: growth_card_pendding
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
                colors: [danger,success,warning]
            };
            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }
        return {
                init: function (growth_card_fail,growth_card_susscess,growth_card_pendding,growth_day) {
                    topup_card(growth_card_fail,growth_card_susscess,growth_card_pendding,growth_day);
                }
            };
        }();
        function TopupCard(year,month){
            $.ajax({
                type: "GET",
                url: "{{route('admin.growth.topup-card')}}",
                data:{
                    year:year,
                    month:month
                },
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    if(data.success == true){
                        var growth_card_fail = data.data.growth_card_fail;
                        growth_card_fail = $.map(growth_card_fail, function(value, index) {
                            return [value];
                        });
                        var growth_card_susscess = data.data.growth_card_susscess;
                        growth_card_susscess = $.map(growth_card_susscess, function(value, index) {
                            return [value];
                        });
                        var growth_card_pendding = data.data.growth_card_pendding;
                        growth_card_pendding = $.map(growth_card_pendding, function(value, index) {
                            return [value];
                        });
                        var growth_day = data.data.growth_day;
                        growth_day = $.map(growth_day, function(value, index) {
                            return [value];
                        });
                        ChartsTopupCard.init(growth_card_fail,growth_card_susscess,growth_card_pendding,growth_day);
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
        //setup biểu đồ mua thẻ
        var ChartsStoreCard = function () {
            var store_card = function (growth_fail,growth_susscess,growth_pendding,growth_day) {
            const apexChart = "#store_card";
            var options = {
                series: [
                    {
                        name: 'Thất bại',
                        data: growth_fail
                    },
                    {
                        name: 'Thành công',
                        data: growth_susscess
                    },
                    {
                        name: 'Đang chờ',
                        data: growth_pendding
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
                colors: [danger,success,warning]
            };
            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }
        return {
                init: function (growth_fail,growth_susscess,growth_pendding,growth_day) {
                    store_card(growth_fail,growth_susscess,growth_pendding,growth_day);
                }
            };
        }();
        function StoreCard(year,month){
            $.ajax({
                type: "GET",
                url: "{{route('admin.growth.store-card')}}",
                data:{
                    year:year,
                    month:month
                },
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    if(data.success == true){
                        var growth_fail = data.data.growth_fail;
                        growth_fail = $.map(growth_fail, function(value, index) {
                            return [value];
                        });
                        var growth_susscess = data.data.growth_susscess;
                        growth_susscess = $.map(growth_susscess, function(value, index) {
                            return [value];
                        });
                        var growth_pendding = data.data.growth_pendding;
                        growth_pendding = $.map(growth_pendding, function(value, index) {
                            return [value];
                        });
                        var growth_day = data.data.growth_day;
                        growth_day = $.map(growth_day, function(value, index) {
                            return [value];
                        });
                        ChartsStoreCard.init(growth_fail,growth_susscess,growth_pendding,growth_day);
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
        // setup biểu đồ nạp tiền qua tài khoản ngân hàng
        var ChartsTopupBank = function () {
            var topup_bank = function (growth_fail,growth_susscess,growth_pendding,data_cancelled,growth_day) {
            const apexChart = "#topup_bank";
            var options = {
                series: [
                    {
                        name: 'Thất bại',
                        data: growth_fail
                    },
                    {
                        name: 'Thành công',
                        data: growth_susscess
                    },
                    {
                        name: 'Đang chờ thanh toán',
                        data: growth_pendding
                    },
                    {
                        name: 'Đã hủy',
                        data: data_cancelled
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
                colors: [danger,success,warning,primary]
            };
            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }
        return {
                init: function (growth_fail,growth_susscess,growth_pendding,data_cancelled,growth_day) {
                    topup_bank(growth_fail,growth_susscess,growth_pendding,data_cancelled,growth_day);
                }
            };
        }();
        function TopupBank(year,month){
            $.ajax({
                type: "GET",
                url: "{{route('admin.growth.topup-bank')}}",
                data:{
                    year:year,
                    month:month
                },
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    if(data.success == true){
                        var growth_fail = data.data.growth_fail;
                        growth_fail = $.map(growth_fail, function(value, index) {
                            return [value];
                        });
                        var growth_susscess = data.data.growth_susscess;
                        growth_susscess = $.map(growth_susscess, function(value, index) {
                            return [value];
                        });
                        var growth_pendding = data.data.growth_pendding;
                        growth_pendding = $.map(growth_pendding, function(value, index) {
                            return [value];
                        });
                        var growth_cancelled = data.data.growth_cancelled;
                        growth_cancelled = $.map(growth_cancelled, function(value, index) {
                            return [value];
                        });
                        var growth_day = data.data.growth_day;
                        growth_day = $.map(growth_day, function(value, index) {
                            return [value];
                        });
                        ChartsTopupBank.init(growth_fail,growth_susscess,growth_pendding,growth_cancelled,growth_day);
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
        var ChartDonate = function () {
            var _donate = function (growth_fail,growth_susscess,growth_pendding,data_cancelled,growth_day) {
            const apexChart = "#chart_donate";
            var options = {
                series: [{
                    name: 'Thành công',
                    data: growth_susscess,
                }, {
                    name: 'Thất bại',
                    data: growth_fail,
                }, {
                    name: 'Đang chờ thanh toán',
                    data: growth_pendding,
                }, {
                    name: 'Đã hủy',
                    data: data_cancelled,
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
                    }
                    },
                    responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                        }
                    }
                    }],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            borderRadius: 5
                        },
                    },
                    xaxis: {
                        categories: growth_day,
                    },
                    colors: [success, danger, warning, drak],
                    legend: {
                        position: 'right',
                        offsetY: 40
                        },
                    fill: {
                        opacity: 1
                    }
                    
                    
            };
            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
	    }
        return {
                init: function (growth_fail,growth_susscess,growth_pendding,data_cancelled,growth_day) {
                    _donate(growth_fail,growth_susscess,growth_pendding,data_cancelled,growth_day);
                }
            };
        }();
        function Donate(year,month){
            $.ajax({
                type: "GET",
                url: "{{route('admin.growth.donate')}}",
                data:{
                    year:year,
                    month:month
                },
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    if(data.success == true){
                        var growth_fail = data.data.growth_fail;
                        growth_fail = $.map(growth_fail, function(value, index) {
                            return [value];
                        });
                        var growth_susscess = data.data.growth_susscess;
                        growth_susscess = $.map(growth_susscess, function(value, index) {
                            return [value];
                        });
                        var growth_pendding = data.data.growth_pendding;
                        growth_pendding = $.map(growth_pendding, function(value, index) {
                            return [value];
                        });
                        var growth_cancelled = data.data.growth_cancelled;
                        growth_cancelled = $.map(growth_cancelled, function(value, index) {
                            return [value];
                        });
                        var growth_day = data.data.growth_day;
                        growth_day = $.map(growth_day, function(value, index) {
                            return [value];
                        });
                        ChartDonate.init(growth_fail,growth_susscess,growth_pendding,growth_cancelled,growth_day);
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
            GrowthIdol();
            $('body').on('change','#growth_idol_year',function(){
                year = $(this).val();
                $("#growth_idol").fadeOut(700,function(){
                    $( "#growth_idol" ).load(window.location.href + " #growth_idol" );
                    GrowthIdol(Number(year))
                    setTimeout(function(){
                        $("#growth_idol").fadeIn(700);
                     }, 2000);
                });
            })
            ClassifyUser();
            TopupCard();
            $('body').on('change','#topup_card_year',function(){
                year = $(this).val();
                month = $('#topup_card_month').val();
                $("#topup_card").fadeOut(700,function(){
                    $( "#topup_card" ).load(window.location.href + " #topup_card" );
                    TopupCard(Number(year),Number(month))
                    setTimeout(function(){
                        $("#topup_card").fadeIn(700);
                     }, 4000);
                });
            })
            $('body').on('change','#topup_card_month',function(){
                month = $(this).val();
                year = $('#topup_card_year').val();
                $("#topup_card").fadeOut(700,function(){
                    $( "#topup_card" ).load(window.location.href + " #topup_card" );
                    TopupCard(Number(year),Number(month))
                    setTimeout(function(){
                        $("#topup_card").fadeIn(700);
                     }, 4000);
                });
            })
            StoreCard();
            $('body').on('change','#store_card_year',function(){
                year = $(this).val();
                month = $('#store_card_month').val();
                $("#store_card").fadeOut(700,function(){
                    $( "#store_card" ).load(window.location.href + " #store_card" );
                    StoreCard(Number(year),Number(month))
                    setTimeout(function(){
                        $("#store_card").fadeIn(700);
                     }, 4000);
                });
            })
            $('body').on('change','#store_card_month',function(){
                month = $(this).val();
                year = $('#store_card_year').val();
                $("#store_card").fadeOut(700,function(){
                    $( "#store_card" ).load(window.location.href + " #store_card" );
                    StoreCard(Number(year),Number(month))
                    setTimeout(function(){
                        $("#store_card").fadeIn(700);
                     }, 4000);
                });
            })
            TopupBank();
            $('body').on('change','#topup_bank_year',function(){
                year = $(this).val();
                month = $('#topup_bank_month').val();
                $("#topup_bank").fadeOut(700,function(){
                    $( "#topup_bank" ).load(window.location.href + " #topup_bank" );
                    TopupBank(Number(year),Number(month))
                    setTimeout(function(){
                        $("#topup_bank").fadeIn(700);
                     }, 4000);
                });
            })
            $('body').on('change','#topup_bank_month',function(){
                month = $(this).val();
                year = $('#topup_bank_year').val();
                $("#topup_bank").fadeOut(700,function(){
                    $( "#topup_bank" ).load(window.location.href + " #topup_bank" );
                    TopupBank(Number(year),Number(month))
                    setTimeout(function(){
                        $("#topup_bank").fadeIn(700);
                    }, 4000);
                });
            })
            Donate();
            $('body').on('change','#donate_year',function(){
                year = $(this).val();
                month = $('#donate_month').val();
                $("#chart_donate").fadeOut(700,function(){
                    $( "#chart_donate" ).load(window.location.href + " #chart_donate" );
                    Donate(Number(year),Number(month))
                    setTimeout(function(){
                        $("#chart_donate").fadeIn(700);
                     }, 4000);
                });
            })
            $('body').on('change','#donate_month',function(){
                month = $(this).val();
                year = $('#donate_year').val();
                $("#chart_donate").fadeOut(700,function(){
                    $( "#chart_donate" ).load(window.location.href + " #chart_donate" );
                    Donate(Number(year),Number(month))
                    setTimeout(function(){
                        $("#chart_donate").fadeIn(700);
                     }, 4000);
                });
            })
        });
    </script>


@endsection
@endrole