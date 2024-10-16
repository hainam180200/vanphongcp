@extends('frontend.layouts.master')
@section('seo_head')
@include('frontend.widget.__seo_head')
@endsection
@section('content')
<section>
   <div class="container">
      <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
         <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="/"><span itemprop="name" content="Trang chủ"><i class="fas fa-home"></i></i> Trang chủ</span></a>
            <meta itemprop="position" content="1" />
         </li>
         @if (isset($currentCategory))
         <li><i class="fas fa-chevron-right"></i></li>
         <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{isset($currentCategory->url) ? $currentCategory->url : $currentCategory->slug}}"><span itemprop="name" content="{{$currentCategory->title}}">{{$currentCategory->title}}</span></a>
            <meta itemprop="position" content="2" />
         </li>
         @endif
         <li><i class="fas fa-chevron-right"></i></li>
         <li itemprop="itemListElement">
            <a itemprop="item" href="{{isset($data->url) ? $data->url : $data->slug}}" title="{{$data->title}}">{{$data->title}}</span></a>
            <meta itemprop="position" content="3" />
         </li>
      </ol>
   </div>
</section>
<section>
   <div class="container">
      <div class="product-details">
         <div class="top-product">
            <h1 class="bk-product-name">
               {{$data->title}}
            </h1>
            <img src="{{\App\Library\Files::media($data->image)}}" class="bk-product-image" alt="" hidden>
            <input type="hidden" value="1" class="bk-product-qty">
         </div>

         <div class="product-details-container">
            <div class="product-image">
               <div class="love-this-button">
                   @if(auth()->guard('frontend')->check())
                   <button class="btn-favourite" data-id="{{$data->id}}">
                       @if ($favourite == 1)
{{--                           <i class="fas fa-heart"></i>--}}
                           <i class="fas fa-heart"></i>
                       @else
                           <i class="far fa-heart"></i>
                       @endif
                   </button>
                   @else
                       <button class='success btn-favourite-login'>
                           <i class="far fa-heart"></i>
                       </button>
                   @endif

               </div>
                <script>
                    // $('.btn-favourite').click(function(){

                    const csrf_token = $('meta[name="csrf-token"]').attr('content');
                    $('body').on('click','.btn-favourite',function(){
                        id = $(this).data('id');
                        $.ajax({
                            type: "POST",
                            url: "/user/favourite/"+id,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:{
                                token: csrf_token,
                            },
                            beforeSend: function (xhr) {
                                $(this).prop('disabled', true);

                            },
                            success: function (data) {
                                if(data.status == 1){
                                    if(data.favourite == true){
                                        $('.btn-favourite').html('<i class="fas fa-heart"></i>')
                                    }
                                    else if(data.favourite == false){
                                        $('.btn-favourite').html('<i class="far fa-heart"></i>')
                                    }
                                }
                            },
                            error: function (data) {

                            },
                            complete: function (data) {
                                $(this).prop('disabled', false);
                            }
                        });
                    });
                </script>
               <div id="imagePreview">
                  <!-- Loading Screen -->
                  <div data-u="loading" class="loading">
                     <div class="filter"></div>
                     <div class="load-bg"></div>
                  </div>
                  <div data-u="slides" class="viewer">
                     @if (isset($data->image_extension))
                     @foreach (json_decode($data->image_extension) as $key => $item)
                     <div>
                        <a data-fancybox="gallery" rel="group" class="slides_detail" href="{{\App\Library\Files::media($item)}}">
                        <img data-u="image" src="{{\App\Library\Files::media($item)}}" title="{{$data->title}}"/>
                        </a>
                        <div data-u="thumb">
                           <img class="i" src="{{\App\Library\Files::media($item)}}" />
                        </div>
                     </div>
                     @endforeach
                     @endif
                  </div>
                  <!-- Thumbnail Navigator -->
                  <div data-u="thumbnavigator" class="jssort11" data-autocenter="1" data-scale-bottom="0.75">
                     <!-- Thumbnail Item Skin Begin -->
                     <div class="bg-shadow" style="top: 0;left: -30px;width: 370px;height: 80px;position: absolute;box-shadow: 0px 4px 6px #00000029; border-radius: 8px;"></div>
                     <div data-u="slides" style="cursor:pointer;">
                        <div data-u="prototype" class="p">
                           <div data-u="thumbnailtemplate" class="tp"></div>
                        </div>
                     </div>
                     <span class="slider-t-l">
                     <i class="fas fa-caret-right"></i>
                     </span>
                     <span class="slider-t-r">
                     <i class="fas fa-caret-right"></i>
                     </span>
                     <!-- Thumbnail Item Skin End -->
                  </div>
                  <!-- Arrow Navigator -->
                  <span data-u="arrowleft" class="slider-l" data-autocenter="2">
                  <i class="fas fa-caret-left"></i>
                  </span>
                  <span data-u="arrowright" class="slider-r" data-autocenter="2">
                  <i class="fas fa-caret-right"></i>
                  </span>
               </div>
            </div>
            <div class="product-center">
               <p class="price current-product-price">
                  <strong class="bk-product-price">
                  {{number_format($data->price)}} ₫
                  </strong>
                  @if (isset($data->price_old) && (int)$data->price_old > 0)
                  <i><strike>{{number_format($data->price_old)}} ₫</strike></i>
                  @endif
                  <i> | Giá đã bao gồm 10% VAT</i>
               </p>
               <p class="freeship">
                  <img src="/assets/frontend/image/vans.svg" alt="" style="width: 20px;padding-right: 8px;filter: invert(88%) sepia(89%) saturate(6%) hue-rotate(184deg) brightness(111%) contrast(97%);"> <span>Miễn phí vận chuyển toàn quốc</span>
               </p>
               <form action="" id="formDetails">
                  {{ csrf_field() }}
                  <input type="text" name="id" id="id_prd" value="{{$data->id}}" hidden>
                  @if (isset($data_attribute) && count($data_attribute) > 0)
                  @foreach ($data_attribute as $key_at => $item)
                  @if ($item['type'] === 1)
                  <div class="product-option color">
                     <strong class="label">{{$item['title']}}</strong>
                     <div class="options " id="">
                        @if (isset($item['content']) && count($item['content']) > 0)
                        @php
                        $firstKey = array_key_first($item['content']);
                        @endphp
                        @foreach ($item['content'] as $key => $item_sub)
                        <div id="colorOptions" class="item-out ">
                           <input type="radio" id="item_{{$key_at}}_{{$key}}"  name="options[{{$key_at}}]" value="{{$key}}"  {{$key == $firstKey ? 'checked' : null}} hidden>
                           <label for="item_{{$key_at}}_{{$key}}">
                              <div class="item ">
                                 <span>
                                    <div ><i class="fas fa-check"></i></div>
                                    <div><strong>{{ $item_sub }}</strong></div>
                                 </span>
                                 <strong>{{number_format($data->price)}} ₫</strong>
                                 <div class="colorGuide" style="background:#2071fc">
                                    <div><strong>{{ $item_sub }}</strong></div>
                                 </div>
                              </div>
                           </label>
                        </div>
                        @endforeach
                        @endif
                     </div>
                  </div>
                  @endif
                  @endforeach
                  @endif
               </form>
               {{--màu sắc--}}
               @if (isset($data->promotion))
               <div class="product-promotion">
                  <strong class="label">KHUYẾN MÃI</strong>
                  <ul>
                     @foreach (json_decode($data->promotion) as $key => $item)
                     <li><span class="bag">KM {{$key + 1}}</span></li>
                     <li>{{$item}}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               <div class="product-action">
                  <!-- BK BUTTON -->
                  <div class='bk-btn'></div>
                  <!-- END BK BUTTON -->
                  {{-- <a title="Mua ngay"  class="btn-red btnQuickOrder btnbuy buy_now_button"><strong>MUA NGAY</strong><span> Giao tận nhà (COD) hoặc Nhận tại cửa hàng</span></a>
                  @if (isset($data->is_installment) && $data->is_installment == 1)
                  <a title="Mua trả góp" href="/tra-gop/{{isset($data->url) ? $data->url : $data->slug}}" class="btnInstallment btn-green btnbuy"><strong>TRẢ GÓP</strong><span>C.Ty Tài chính, Thẻ tín dụng</span></a>
                  @endif --}}
                  {{-- <a title="Thêm vào giỏ hàng" data-sku="I13M512B" href="javascript:;" class="btn-orange btnbuy btn-icon" id="add-cart"><i class="fas fa-cart-plus"></i></a> --}}
               </div>
               <div class="modal buy_now ">
                  <div class="modal-overlay buy_now_button"></div>
                  <div class="modal-wrapper modal-transition">
                     <div class="modal-header">
                        <button class="modal-close buy_now_button"><i class="fas fa-times"></i></button>
                     </div>
                     <div class="quick-order">
                        <div class="quick-order-ctn">
                           <div class="left">
                              <div class="img">
                                 <img src="{{ isset($data->image)?\App\Library\Files::media($data->image) : null }}" alt="{{isset($data->title) ? $data->title : null}}" />
                              </div>
                              <div class="info">
                                 <p class="title">
                                    {{isset($data->title) ? $data->title : null}} <br />
                                 </p>
                                 <p class="price">
                                    <strong id="quickOrderPrice">{{number_format($data->price)}} ₫</strong>
                                    @if (isset($data->percent_sale) && $data->percent_sale > 0)
                                    <strike id="quickOrderPriceLast">{{number_format($data->price_old)}} ₫</strike>
                                    @endif
                                 </p>
                              </div>
                              @if (isset($data->promotion))
                              <div class="promote" id="quickFormPromote">
                                 <div class="offer-items" id="of_FLIP36K">
                                    @foreach (json_decode($data->promotion) as $key => $item)
                                    <div class="offer">
                                       <div class="stt">
                                          <label>KM{{$key + 1}}</label>
                                       </div>
                                       <div class="offer-border">
                                          <div class="content">
                                             <label class="radio-ctn">
                                             <span>{{$item}}</span>
                                             {{-- <input checked class="cart-promote" type="radio" name="promotion" value="promotion">
                                             <span class="checkmark"></span> --}}
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                    @endforeach
                                 </div>
                                 <div>

                                 </div>
                                 <div class="hot-line">
                                    <a href="tel:19002091"><i class="icon-hotline"></i> <strong>{{setting('sys_phone')}}</strong></a>
                                    <p>
                                       <i>Hotline tư vấn bán hàng</i><br />
                                    </p>
                                 </div>
                              </div>
                               @endif
                           </div>
                           <div class="right">
                              <h3>Đặt hàng sản phẩm</h3>
                              <form method="POST" action="/order-now/{{$data->id}}" id="formBuyNow">
                                {{ csrf_field() }}
                                 @if (isset($data_attribute) && count($data_attribute) > 0)
                                 <div class="grid-options">
                                        @foreach ($data_attribute as $key_at => $item)
                                            @if ($item['type'] === 1)
                                                <label><strong>{{$item['title']}}</strong></label>
                                                @if (isset($item['content']) && count($item['content']) > 0)
                                                @php
                                                    $firstKey = array_key_first($item['content']);
                                                @endphp
                                                    <div class="options">
                                                        @foreach ($item['content'] as $key => $item_sub)
                                                            <div class="options_color">
                                                                <input type="radio" id="color_{{$key_at}}_{{$key}}" name="options[{{$key_at}}]" value="{{$key}}" {{$key == $firstKey ? 'checked' : null}} hidden>
                                                                <label for="color_{{$key_at}}_{{$key}}">
                                                                    <div class="option">
                                                                        <a class="select_color" >
                                                                            <div class="text-center">
                                                                                {{-- <i class="icon-border" style="background-color:#2a0808"></i> --}}
                                                                                <span>{{ $item_sub }}</span>
                                                                            </div>
                                                                            <strong class="text-red">{{number_format($data->price)}} ₫</strong>
                                                                        </a>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                 @endif
                                 <div class="number">
                                    <label>Số lượng</label>
                                    <div class="control">
                                       <button type="button" id="btnMinutes" class="minus">-</button>
                                        <input type="number" id="Number" value="1" min="1" class="quantity" name="quantity" max="10" style="width: 30px;padding: 0 0 0 12px;" />
                                       <button type="button" id="btnPlus" class="plus">+</button>
                                    </div>
                                 </div>

                                 <div class="cart-form quick-order-form">
                                    <label>Họ tên</label>
                                    <div class="row">
                                       <div class="col">
                                          <div class="control">
                                             <input name="fullname" type="text" placeholder="Họ và tên *" required />
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col">
                                          <label>Điện thoại</label>
                                          <div class="control">
                                             <input name="phone" type="tel" placeholder="Số điện thoại *" required />
                                          </div>
                                       </div>
                                       <div class="col">
                                          <label>Email</label>
                                          <div class="control">
                                             <input name="email" type="email" placeholder="Email" required />
                                          </div>
                                       </div>
                                    </div>
                                    <label>Địa chỉ</label>
                                       <div class="row">
                                          <div class="col">
                                             <div class="control">
                                                @include('frontend.widget.desktop._system_address_provinces')
                                             </div>
                                          </div>
                                          <div class="col">
                                             <div class="control">
                                                <select id="districts" name="districts" placeholder="Quận/Huyện *" required>
                                                    <option value="">Quận/Huyện *</option>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <label>Cụ thể</label>
                                       <div class="row">
                                          <div class="col">
                                             <div class="control">
                                                <input name="address" type="text" placeholder="Địa chỉ cụ thể" required />
                                             </div>
                                          </div>
                                       </div>
                                    <div class="row">
                                       <div class="col">
                                          <div class="control">
                                             <textarea name="note" placeholder="Ghi chú"></textarea>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row shInfo">
                                       <p>Bằng cách đặt hàng bạn đã đồng ý với điều khoản sử dụng và chính sách đổi trả</p>
                                    </div>
                                    <div class="row shInfo">
                                       <div class="control-button">
                                        @if (auth()->guard('frontend')->check())
                                            <button type="submit">TIẾN HÀNH ĐẶT HÀNG</button>
                                        @else
                                            <a href="/login"><button type="button">VUI LÒNG ĐĂNG NHẬP ĐỂ ĐẶT HÀNG</button></a>
                                        @endif
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
             <div class="product-shop">
                 @if (isset($data->insurance))
                     <div class="warranty">
                         <h4>THÔNG TIN BẢO HÀNH</h4>
                         {!! $data->insurance !!}
                     </div>
                 @endif
                 <div class="check-stock" id="marketFilter">
                     <div class="city">
                         <p>Địa chỉ mua hàng trực tiếp</p>
                     </div>
                     <div class="store">
                         <ul>
                             <li><span>{{setting('sys_address')}}<a href="#">Bản đồ đường đi</a></span></li>
                         </ul>
                     </div>
                 </div>
                 <div class="out-date">
                     <p class="title">
                        <strong>
                             <a style="color: #000;font-size:14px" href="{{isset($data->url) ? $data->url : $data->slug}}">{{$data->title}} - {{setting('sys_title')}}</a>
                        </strong>
                     </p>
                     <div class="note">
                         <p><i>Giá chỉ từ:</i> <strong class="text-red">{{number_format($data->price)}} ₫</strong></p>
                         @if (isset($data->percent_sale) && (int)$data->percent_sale > 0)
                             <p><i>Tiết kiệm:</i> <strong class="text-red">{{number_format($data->price_old - $data->price)}} ₫</strong></p>
                         @endif
                         {{\Carbon\Carbon::now()->format('d/m/yy')}}
                     </div>
                 </div>
             </div>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container">
      <div class="product-layout product-layout-grid">
         <div class="product-left">
            @if ($data->content)
            <div class="product-text" id="productContent">
               {!! $data->content !!}
            </div>
            <div class="view-more-container">
               <a href="javascript:;" id="viewMoreContent">Xem thêm</a>
            </div>
            @endif
         </div>
         <div class="product-right">
            <div class="product-specs">
               <h3>Thông số kỹ thuật {{$data->title}}</h3>
               <div class="product-spect-img">
                  <img src="{{\App\Library\Files::media($data->image)}}" title="{{$data->title}}" class="img-fluid" />
                  <a data-padding="0px" data-width="600px" class="modal-toggle product-specs-button detail_config_button_cauhinh"><span class="icon-config"></span><i class="fas fa-tools"></i> <strong>Cấu hình chi tiết</strong></a>
{{--                   <a data-padding="0px" data-width="600px" class="product-specs-button "><span class="icon-config"></span><i class="fas fa-tools"></i> <strong>Cấu hình chi tiết</strong></a>--}}

               </div>
               <div class="modal detail_config_cauhinh ">
                  <div class="modal-overlay detail_config_button_cauhinh"></div>
                  <div class="modal-wrapper modal-transition">
                     <div class="modal-header">
                        <button class="modal-close detail_config_button_cauhinh"><i class="fas fa-times"></i></button>
                        <table class="table table-border">
                           <tbody>
                           <tr>
                               <th colspan="2">
                                   <span class="f-16">Bộ xử lý</span>
                               </th>
                           </tr>
                           @if (isset($data_attribute) && count($data_attribute) > 0)
                               @foreach ($data_attribute as $item)
                               <tr>

                                       @if ($item['type'] === 2)
                                           @if (isset($item['content']) && count($item['content']) > 0)
                                               <td class="table-gray">
                                                   <strong>{{$item['title']}}:</strong>
                                               </td>
                                               <td>
                                                   <span>
                                                 @foreach ($item['content'] as $key => $item_sub)
                                                           <span>{{$item_sub}}</span>
                                                       @endforeach
                                                   </span>
                                               </td>

                                           @endif
                                       @endif

                               </tr>
                               @endforeach
                           @endif


                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               @if (isset($data_attribute) && count($data_attribute) > 0)
               <div class="specs-special">
                  @foreach ($data_attribute as $item)
                  @if ($item['type'] === 2)
                  @if (isset($item['content']) && count($item['content']) > 0)
                  <ol>
                     <li>
                        <strong>{{$item['title']}}:</strong>
                        @foreach ($item['content'] as $key => $item_sub)
                        <span>{{$item_sub}}</span>
                        @endforeach
                     </li>
                  </ol>
                  @endif
                  @endif
                  @endforeach
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</section>
{{--    sản phẩm tương tự--}}
@if(isset($items_prd) && count($items_prd) > 0)
<section>
   <div class="container">
      <div class="full-width-content">
         <div class="product-quick-compare">
            <div class="header">
               <h3>So sánh sản phẩm tương tự</h3>
               {{-- <div class="search-box">
                  <div class="border">
                     <input id="kwdCompare" type="text" placeholder="Nhập tên sản phẩm cần so sánh"/>
                     <button type="button" class="search"><i class="fas fa-search"></i></button>
                  </div>
               </div> --}}
            </div>
            <div class="lts-product lts-product-bgwhite equaHeight" data-obj="a.title">
               @if(isset($items_prd) && count($items_prd) > 0)
                  @foreach($items_prd as $key => $item)
                     <div class="item">
                        <div class="img">
                           <a href="{{isset($item->url) ? $item->url : $item->slug}}" title="{{isset($item->url) ? $item->url : $item->slug}}">
                           <img src="{{ isset($item->image)?\App\Library\Files::media($item->image): null }}" alt="{{isset($item->url) ? $item->url : $item->slug}}" title="{{isset($item->title) ? $item->title :null}}">
                           </a>
                        </div>
                        @if (isset($item->percent_sale) && (int)$item->percent_sale > 0)
                        <span class="sales">
                        <i class="fas fa-bolt"></i> Giảm {{number_format($item->price)}} ₫
                        </span>
                        @endif
                        <div class="info">
                           <a href="/{{isset($item->url) ?$item->url : $item->slug}}" class="title" title="{{$item->title}}">{{$item->title}}</a>
                           <span class="price">
                           <strong>{{number_format($item->price)}} ₫</strong>
                           @if (isset($item->percent_sale) && (int)$item->percent_sale > 0)
                           <strike>{{$item->price_old}} ₫</strike>
                           @endif
                           </span>
                        </div>
                        <div class="info-compare">
                           <a href="/so-sanh/{{$data->slug}}-voi-{{$item->slug}}" title="{{$item->title}}"><i class="fas fa-sort-amount-up-alt"></i> <span>So sánh</span></a>
                        </div>
                     </div>
                  @endforeach
               @endif
            </div>
         </div>
      </div>
   </div>
</section>
@endif
<!-- news -->
<section>
   <div class="container">
      <div class="news-home box-home">
         <div class="col-content">
             @if(isset($items_blog) && count($items_blog) > 0)
                 @foreach($items_blog as $groupitem)
                     <div class="item">
                         <div class="img">
                             <a href="/blog/{{isset($groupitem->url) ? $groupitem->url : $groupitem->slug}}"><img src="{{ isset($groupitem->image)?\App\Library\Files::media($groupitem->image): null }}"></a>
                         </div>
                         <p>
                             <a href="/blog/{{isset($groupitem->url) ? $groupitem->url : $groupitem->slug}}">{{isset($groupitem->title) ? $groupitem->title : ''}}</a>
                             <br />
                             <i>{{isset($groupitem->created_at) ? $groupitem->created_at->format('Y.m.d')  : ''}}</i>
                         </p>
                     </div>
                 @endforeach
             @endif

         </div>
      </div>
   </div>
</section>
<!-- BK MODAL -->
<div id='bk-modal'></div>
<!-- END BK MODAL -->


{{--comment--}}
@include('frontend.pages.desktop.comment')
{{--</section>--}}


{!! widget('frontend.widget.desktop._section_widget_banner_nature') !!}


@endsection
