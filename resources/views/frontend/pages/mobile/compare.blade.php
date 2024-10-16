@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('content')
    {{--    @dd($data)--}}

    <section>
        <div class="container scroll">
            <div class="compare scroll-x">

                <table class="table tab-content table-bordered table-striped table-compare">
                    <tr class="specs-group">
                        <th colspan=" 4">Thông tin chung</th>
                    </tr>

                    <tr class="specs equaHeight" data-obj="h3">

                        <td class="text " style="width:17.5%;">Hình ảnh, giá</td>
                        @foreach($data as $item)
                            <td class="item image" style="width:27.5%">
                                <p style="text-align:right;"><a href="/{{ isset($item->url)?$item->url : $item->slug }}" class="remove" title="{{ isset($item->title)?$item->title : null }}"><i class="fas fa-minus"></i></a></p>
                                <div class="image">
                                    <a href="/{{ isset($item->url)?$item->url : $item->slug }}">
{{--                                        <img src="https://cdn.hoanghamobile.com/i/productlist/ts/Uploads/2021/09/15/image-removebg-preview-28.png" alt="">--}}
                                        <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" />
                                    </a>
                                </div>
                                <h3><a href="/{{ isset($item->url)?$item->url : $item->slug }}">{{ isset($item->title)?$item->title : null }}</a></h3>
                                <div class="price-note">
                                    <p class="price">
                                        <strong>{{ isset($item->price)? number_format($item->price) : null }} ₫ </strong>

                                        <i> | Giá đã bao gồm 10% VAT</i>
                                    </p>
                                    <p class="note"></p>
                                </div>
                            </td>
                        @endforeach

{{--                        <td class="item" style="width:27.5%">--}}
{{--                            <div class="add-product">--}}
{{--                                <h3>Bạn muốn so sánh thêm sản phẩm?</h3>--}}
{{--                                <div class="input">--}}
{{--                                    <input id="kwdCompare" type="text" placeholder="Tìm kiếm sản phẩm" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </td>--}}

                    </tr>

                    {{--                    Khuyến mại--}}

                    <tr class="specs">
                        <th class="text">Khuyến mại</th>
                        @foreach($data as $item)
                            @if (isset($item->promotion))
                                <td class="data">
                                    <ul>
                                        @foreach (json_decode($item->promotion) as $key => $items)
                                            <li>{{$items}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            @endif
                        @endforeach

                        <td></td>
                    </tr>

                    <tr class="specs">


                        {{--                            @if (isset($data_attribute) && count($data_attribute) > 0)--}}
                        {{--                                @foreach ($data_attribute as $key_at => $itemss)--}}
                        {{--                                    @if ($itemss['type'] === 1)--}}
                        <th class="text">Hệ điều hành</th>
                        @foreach($data as $item)
                            {{--                                        @foreach ($itemss['content'] as $key => $item_sub)--}}
                            @php
                                $data_attribute = [];
                                 $attribute = $item->subitem;
                                 if(isset($attribute) && count($attribute) > 0){
                                     foreach($attribute as $item){
                                         $id_attribute[] = $item->attribute_id;
                                     }
                                     $obj_attribute = App\Models\Item::where('module','=','product-attribute')->where('status',1)->whereIn('id',$id_attribute)->get();
                                     if(isset($obj_attribute) && count($obj_attribute) > 0){
                                         foreach($attribute as $item_at){
                                             foreach($obj_attribute as $item_obj){
                                                 $content_at = [];
                                                 if($item_at->attribute_id == $item_obj->id){
                                                     if(isset($data_attribute[$item_at->attribute_id])){
                                                         $content_at = $data_attribute[$item_at->attribute_id]['content'];
                                                         $content_at[$item_at->id] = $item_at->content;
                                                     }
                                                     else{
                                                         $content_at[$item_at->id] = $item_at->content;
                                                     }
                                                     $data_attribute[$item_at->attribute_id] = [
                                                         'title' => $item_obj->title,
                                                         'content' => $content_at,
                                                         'type' => $item_obj->type,
                                                     ];
                                                 }
                                             }
                                         }
                                     }
                                 }


                            @endphp

                            <td class="data">

                                <ul>
                                    @foreach ($data_attribute as $key_at => $itemss)
                                        @if ($itemss['type'] != 1)
                                            @foreach ($itemss['content'] as $key => $item_sub)
                                                <li>{{ $item_sub }}</li>

                                            @endforeach
                                        @endif
                                    @endforeach
                                </ul>
                            </td>

                        @endforeach
                        {{--                                    @endforeach--}}
                        {{--                                @endif--}}





                        <td></td>
                    </tr>
                    {{--                    @endforeach--}}
                    {{--                    @endif--}}

                    {{--                    Bộ sản phẩm tiêu chuẩn--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Bộ sản phẩm tiêu chuẩn</th>--}}
                    {{--                        <td class="data">--}}

                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}

                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    Bảo hành--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <td class="text">Bảo hành</td>--}}
                    {{--                        <td class="data">Bảo h&#224;nh 12 th&#225;ng ch&#237;nh h&#227;ng, bao x&#224;i đổi lỗi 1 đổi 1 trong v&#242;ng 30 ng&#224;y đầu.</td>--}}
                    {{--                        <td class="data">Bảo h&#224;nh 12 th&#225;ng ch&#237;nh h&#227;ng, bao x&#224;i đổi lỗi 1 đổi 1 trong v&#242;ng 30 ng&#224;y đầu.</td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    Màn hình--}}
                    {{--                    @dd($data)--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4">M&#224;n h&#236;nh</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Hệ điều hành</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}

                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Độ ph&#226;n giải:</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>1640 x 2360 Pixels</li>--}}
                    {{--                                <li>12 MP</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>1668 x 2388 Pixels</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">M&#224;n h&#236;nh rộng:</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>10.9&quot;</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>11&quot;</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    THIẾT KẾ & TRỌNG LƯỢNG--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4">Thiết kế &amp; Trọng lượng</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Chất liệu</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Nh&#244;m nguy&#234;n khối</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">K&#237;ch thước</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>D&#224;i 247.6 mm - Ngang 178.5 mm - D&#224;y 6.1 mm</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Trọng lượng</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>460 g</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4">Hệ điều h&#224;nh &amp; CPU</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Hệ điều h&#224;nh</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>iPadOS 14</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>iPadOS 14</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Chip xử l&#253; (CPU)</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Apple A14 Bionic 6 nh&#226;n</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Apple M1 8 nh&#226;n</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Tốc độ CPU</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Đang cập nhật</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Chip đồ hoạ (GPU)</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Apple GPU 6 nh&#226;n</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Apple GPU 8 nh&#226;n</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Cảm biến</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>Gia tốc</li>--}}
                    {{--                                <li>La b&#224;n</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4">Bộ nhớ &amp; Lưu trữ</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">RAM</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Đang cập nhật</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>8 GB</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Bộ nhớ trong</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>256 GB</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>128 GB</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Bộ nhớ c&#242;n lại (khả dụng)</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Khoảng 241 GB</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Thẻ nhớ ngo&#224;i</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Kh&#244;ng</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Hỗ trợ thẻ tối đa</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4">Camera sau</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Độ ph&#226;n giải:</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>1640 x 2360 Pixels</li>--}}
                    {{--                                <li>12 MP</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>1668 x 2388 Pixels</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Quay phim:</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>4K 2160p@24fps</li>--}}
                    {{--                                <li>4K 2160p@30fps</li>--}}
                    {{--                                <li>4K 2160p@60fps</li>--}}
                    {{--                                <li>FullHD 1080p@120fps</li>--}}
                    {{--                                <li>FullHD 1080p@240fps</li>--}}
                    {{--                                <li>FullHD 1080p@30fps</li>--}}
                    {{--                                <li>FullHD 1080p@60fps</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">T&#237;nh năng;</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>Chống rung EIS</li>--}}
                    {{--                                <li>G&#243;c rộng</li>--}}
                    {{--                                <li>HDR</li>--}}
                    {{--                                <li>Tự đ&#244;̣ng l&#226;́y nét (AF)</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Camera trước</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>7 MP</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4">Camera trước</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Độ ph&#226;n giải:</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>1640 x 2360 Pixels</li>--}}
                    {{--                                <li>12 MP</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>1668 x 2388 Pixels</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">T&#237;nh năng:</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>Chống rung EIS</li>--}}
                    {{--                                <li>G&#243;c rộng</li>--}}
                    {{--                                <li>HDR</li>--}}
                    {{--                                <li>Tự đ&#244;̣ng l&#226;́y nét (AF)</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4"> Kết nối</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Mạng di động</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Hỗ trợ 4G</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Số khe SIM</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>1 Nano SIM hoặc 1 eSIM</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Kh&#244;ng</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Loại SIM</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Thực hiện cuộc gọi</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>FaceTime</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Hỗ trợ 3G</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Hỗ trợ 4G</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">WiFi</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>Dual-band</li>--}}
                    {{--                                <li>Wi-Fi 802.11 a/b/g/n/ac/ax</li>--}}
                    {{--                                <li>Wi-Fi hotspot</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>Dual-band</li>--}}
                    {{--                                <li>Wi-Fi 802.11 a/b/g/n/ac/ax</li>--}}
                    {{--                                <li>Wi-Fi hotspot</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Bluetooth</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>A2DP</li>--}}
                    {{--                                <li>EDR</li>--}}
                    {{--                                <li>v5.0</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>A2DP</li>--}}
                    {{--                                <li>LE</li>--}}
                    {{--                                <li>v5.0</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">GPS</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>GLONASS</li>--}}
                    {{--                                <li>GPS</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <ol class="ol-specs">--}}
                    {{--                                <li>A-GPS</li>--}}
                    {{--                                <li>GLONASS</li>--}}
                    {{--                            </ol>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Cổng k&#234;́t n&#244;́i/sạc</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Type-C</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Type-C</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Jack tai nghe</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Type C</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Type C</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Hỗ trợ OTG</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Kết nối kh&#225;c</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Kh&#244;ng</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4">Tiện &#237;ch</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Ghi &#226;m</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Ghi &#226;m m&#244;i trường</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Radio</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Kh&#244;ng</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">T&#237;nh năng đặc biệt</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Mở kh&#243;a bằng v&#226;n tay</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4">Pin &amp; Sạc</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Dung lượng pin</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Đang cập nhật</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>7538 mAh</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs-group">--}}
                    {{--                        <th class="text" colspan="4">Th&#244;ng tin chung</th>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Chất liệu:</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span>Nh&#244;m nguy&#234;n khối</span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">K&#237;ch thước, khối lượng:</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr class="specs">--}}
                    {{--                        <th class="text">Thời điểm ra mắt:</th>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td class="data">--}}
                    {{--                            <span></span>--}}
                    {{--                        </td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                </table>
            </div>
        </div>
    </section>
@endsection
