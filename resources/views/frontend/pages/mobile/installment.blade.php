@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('content')
    @php
        $parts = parse_url(\Request::fullUrl());
        if(isset($parts['query'])){
            parse_str($parts['query'], $url_params);
        }
        else{
          $url_params = null;
        }
    @endphp
    <section>
        <div class="container">
            <a name="estimation"></a>
            <h1>{{isset($item->item->title) ? $item->item->title : null}}</h1>
            <div class="installment-v2">
                <div class="info">
                    <div class="image">
                        <img src="{{ isset($data->image)?\App\Library\Files::media($data->image) : null }}" />
                    </div>
                    <div class="option">
                        <div class="options">
                            @foreach ($data_attribute as $key => $item)
                                @if ($item['type'] == 1)
                                    <div class="item">
                                        <strong>{{$item['title']}}</strong>
                                        <label>
                                            <i class="fas fa-check"></i>
                                            <span>{{array_values($item['content'])[0]}}</span>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="price-info">
                            <p><label>Giá cuối:</label></p>
                            <p class="price-note">
                                <strong class="price">{{number_format($data->price)}} ₫</strong>
                                @if (isset($data->percent_sale) && $data->percent_sale > 0)
                                    <strike>{{number_format($data->price_old)}} ₫</strike>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="data">
                    <div class="header">
                        <ul>
{{--                            <li><a href="">Trả góp qua thẻ tín dụng</a></li>--}}
                            <li><a href="javascript:;" class="actived">Trả góp qua công ty tài chính</a></li>
                        </ul>
                    </div>

                    <div class="month-opt">
                        <h4>Chọn số tháng trả góp</h4>

                        <ul>
                            <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'month','3')}}" class="{{isset($url_params['month']) && $url_params['month'] == 3 ? 'actived' : null }} {{empty($url_params['month']) ? 'actived' : null }}">3 Tháng</a></li>
                            <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'month','6')}}" class="{{isset($url_params['month']) && $url_params['month'] == 6 ? 'actived' : null }}">6 Tháng</a></li>
                            <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'month','9')}}" class="{{isset($url_params['month']) && $url_params['month'] == 9 ? 'actived' : null }}">9 Tháng</a></li>
                            <li><a href="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'month','12')}}" class="{{isset($url_params['month']) && $url_params['month'] == 12 ? 'actived' : null }}">12 Tháng</a></li>
                        </ul>
                    </div>

                    <div class="table">
                        @if (isset($installment) && count($installment) > 0)
                            @foreach ($installment as $item)
                        <table class="table table-border">
                            <tr>
                                <th>Phương thức trả góp</th>
                                <th><img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" title="{{isset($item->title) ? $item->title : null}}" /></th>
                            </tr>
                            <tr>
                                <td>Giá sản phẩm</td>
                                <td>{{number_format($data->price)}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Trả trước</label>
                                    <select class="select-opt" onchange="location.href = this.value;">
                                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'prepaid_percentage','10')}}" {{isset($url_params['prepaid_percentage']) && $url_params['prepaid_percentage'] == 10 ? 'selected' : null }} >10%</option>
                                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'prepaid_percentage','20')}}" {{isset($url_params['prepaid_percentage']) && $url_params['prepaid_percentage'] == 20 ? 'selected' : null }}>20%</option>
                                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'prepaid_percentage','30')}}" {{isset($url_params['prepaid_percentage']) && $url_params['prepaid_percentage'] == 30 ? 'selected' : null }}>30%</option>
                                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'prepaid_percentage','40')}}" {{isset($url_params['prepaid_percentage']) && $url_params['prepaid_percentage'] == 40 ? 'selected' : null }}>40%</option>
                                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'prepaid_percentage','50')}}" {{isset($url_params['prepaid_percentage']) && $url_params['prepaid_percentage'] == 50 ? 'selected' : null }}>50%</option>
                                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'prepaid_percentage','60')}}" {{isset($url_params['prepaid_percentage']) && $url_params['prepaid_percentage'] == 60 ? 'selected' : null }}>60%</option>
                                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'prepaid_percentage','70')}}" {{isset($url_params['prepaid_percentage']) && $url_params['prepaid_percentage'] == 70 ? 'selected' : null }}>70%</option>
                                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'prepaid_percentage','80')}}" {{isset($url_params['prepaid_percentage']) && $url_params['prepaid_percentage'] == 80 ? 'selected' : null }}>80%</option>
                                        <option value="{{\App\Library\Helpers::getSearch(\Request::fullUrl(),'prepaid_percentage','90')}}" {{isset($url_params['prepaid_percentage']) && $url_params['prepaid_percentage'] == 90 ? 'selected' : null }}>90%</option>
                                    </select>
                                </td>
                                <td>
                                    @if (isset($prepaid_percentage) && (int)$prepaid_percentage > 0)
                                        @php
                                            $installment_p = $data->price * $prepaid_percentage / 100;
                                        @endphp
                                        {{number_format($installment_p)}}
                                    @else
                                        @php
                                            $installment_p =  0;
                                        @endphp
                                        0
                                    @endif
                                    @php
                                        $price_installment = $data->price - $installment_p;
                                    @endphp

                                </td>
                            </tr>
                            <tr>
                                <td>{{config('order.installment.papers')}}</td>
                                <td>{{$item->papers}}</td>
                            </tr>
                            <tr>
                                <td>{{config('order.installment.ratio')}}</td>
                                <td>{{$item->ratio}}</td>
                            </tr>

                            <tr>
                                <td>{{config('order.installment.fee')}}</td>
                                <td>{{number_format($item->fee)}}</td>
                            </tr>
                            <tr>
                                <td>
                                    Tiền đóng tháng đầu<br />
                                    <i class="text-gray">tiền trả trước + phí</i>
                                </td>
                                <td>
                                    @if (isset($month) && (int)$month > 0)
                                        {{-- {{number_format(($price_installment / $month) + ($price_installment * $item->ratio / 100) + $item->fee)}} --}}
                                        {{number_format(($price_installment + ($price_installment * $item->ratio / 100)) / $month)}}
                                    @else
                                        {{-- {{number_format(($price_installment / 3) + ($price_installment * $item->ratio / 100) + $item->fee)}} --}}
                                        {{number_format(($price_installment + ($price_installment * $item->ratio / 100)) / 3)}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Trả góp mỗi tháng</td>
                                <td>
                                    @if (isset($month) && (int)$month > 0)
                                        {{-- {{number_format(($price_installment / $month) + (($price_installment - $price_installment / $month) *$item->ratio / 100) + $item->fee)}} --}}
                                        {{number_format(($price_installment + ($price_installment * $item->ratio / 100)) / $month)}}
                                    @else
                                        {{-- {{number_format(($price_installment / 3) + (($price_installment - $price_installment / 3) *$item->ratio / 100) + $item->fee)}} --}}
                                        {{number_format(($price_installment + ($price_installment * $item->ratio / 100)) / 3)}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng tiền trả<br />
                                    <i class="text-gray">Giá sp + lãi + phí</i>
                                </td>
                                <td>
                                    <span class="text-green">
                                        @if (isset($month) && (int)$month > 0)
                                            {{number_format($month * ($price_installment / $month) + (($price_installment - $price_installment / $month) *$item->ratio / 100) + $item->fee)}}
                                        @else
                                            {{number_format(3 * ($price_installment / 3) + (($price_installment - $price_installment / 3) *$item->ratio / 100) + $item->fee)}}
                                        @endif
                                    </span>
                                </td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td>Chênh lệch</td>--}}
{{--                                <td>33,000</td>--}}
{{--                                <td>33,000</td>--}}
{{--                            </tr>--}}
                        </table>
                            @endforeach
                        @else
                            <p><strong style="color: red">Hệ thống chưa hỗ trợ trả góp</strong></p>
                        @endif
                        @if (isset($installment) && count($installment) > 0)
                            <p  style="color: red"><strong>Lưu ý:</strong> Số tiền thực tế có thể có chênh lệch. Nhân viên sẽ tư vấn tới quý khách hàng khi tiến hành làm hồ sơ trả góp. </p>
                        @endif

                    </div>
                    <div class="cart-form">
                        <form method="POST" id="installmentForm" action="/order-installment/{{$data->id}}">
                            {{ csrf_field() }}
                            <h3>Thông tin liên hệ trả góp</h3>
                            <p class="text-gray"><i>Bạn cần nhập đầy đủ các trường thông tin có dấu *</i></p>
                            <div class="row" style="display: block">
                                <div class="col" style="display: block">
                                    @if (auth()->guard('frontend')->check())
                                        <div class="control">
                                            <input type="text" value="{{auth()->guard('frontend')->user()->username}}" readonly />
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <input type="text" name="month" hidden value="{{isset($month) && (int)$month > 0 ? $month : '3'}}" id="">
                            <input type="text" name="prepaid_percentage" hidden value="{{isset($prepaid_percentage) && (int)$prepaid_percentage > 0 ? $prepaid_percentage : '0'}}" id="">
                            <div class="row" style="display: block">
                                <div class="col" style="display: block">
                                    <div class="control">
                                        <input name="fullname" value="{{isset(auth()->guard('frontend')->user()->fullname) ? auth()->guard('frontend')->user()->fullname : null }}" type="text" placeholder="Họ và tên *" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: block">
                                <div class="col" style="display: block">
                                    <div class="control">
                                        <input name="phone" type="phone" value="{{isset(auth()->guard('frontend')->user()->phone) ? auth()->guard('frontend')->user()->phone : null }}" placeholder="Số điện thoại *" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row shInfo" style="display: block">
                                <div class="col" style="display: block">
                                    <div class="control">
                                        <input name="email" value="{{isset(auth()->guard('frontend')->user()->email) ? auth()->guard('frontend')->user()->email : null }}" type="email" placeholder="Email" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row shInfo" style="display: block">
                                <div class="col" style="display: block">
                                    <div class="control">
                                        <textarea name="note" placeholder="Ghi chú" spellcheck="false" data-minlength="15"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row shInfo" style="display: block">
                                @if (auth()->guard('frontend')->check())
                                    <div class="control-button">
                                        <button type="submit">GỬI YÊU CẦU</button>
                                    </div>
                                @else
                                    <div class="control-button">
                                        <a href="/login"><button type="button">VUI LÒNG ĐĂNG NHẬP ĐỂ ĐẶT HÀNG</button></a>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>


                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="container">

        </div>
    </section>

    @include('frontend.pages.desktop.comment')
@endsection
