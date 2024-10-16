@extends('frontend.layouts.master_blog')
@section('seo_head')
@include('frontend.widget.__seo_head')
@endsection
@push('style')
<link rel="stylesheet" href="/assets/frontend/css/news.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
@endpush
@push('js')
<script type='text/javascript' src='/assets/frontend/lib/jquery.min.js'></script>
<script type='text/javascript' src='/assets/frontend/lib/jquery-migrate.min.js'></script>
@endpush
@section('content')
@if (isset($breadcumb) && count($breadcumb) > 0)
@foreach ($breadcumb as $key => $item)
<div class="td-category-header td-container-wrap">
   <div class="td-container">
      <div class="td-pb-row">
         <div class="td-pb-span12">
            <div class="td-crumb-container"></div>
            <h1 class="entry-title td-page-title">{{$item->title}}</h1>
         </div>
      </div>
   </div>
</div>
@endforeach
@else
<div class="td-category-header td-container-wrap">
   <div class="td-container">
      <div class="td-pb-row">
         <div class="td-pb-span12">
            <div class="td-crumb-container"></div>
            <h1 class="entry-title td-page-title">{{$data->title}}</h1>
         </div>
      </div>
   </div>
</div>
@endif
<!-- big grid -->
<div class="td-category-grid td-container-wrap">
   <div class="td-container">
      <div class="td-pb-row">
         <div class="td-pb-span12">
            <div class="td_block_wrap td_block_big_grid_12 tdi_2_c2a td-grid-style-1 td-hover-1 td-big-grids td-pb-border-top td_block_template_1"  data-td-block-uid="tdi_2_c2a" >
               <div id=tdi_2_c2a class="td_block_inner">
                  <div class="td-big-grid-wrapper">
                    @if (isset($items_prd) && count($items_prd) > 0)
                        @foreach ($items_prd as $key => $item)
                        @if ($key < 3)
                            <div class="{{ $key = 0 ? 'td_module_mx5 td-animation-stack td-big-grid-post-0 td-big-grid-post td-big-thumb' : 'td_module_mx11 td-animation-stack td-big-grid-post-1 td-big-grid-post td-medium-thumb' }}">
                                <div class="td-module-thumb">
                                    <a href="{{isset($item->url) ? $item->url : $item->slug}}" rel="bookmark" class="td-image-wrap" title="{{isset($item->title) ? $item->title : null}}">
                                        <img width="534" height="462" class="entry-thumb" src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}"   alt="1200&#215;628 ảnh vong quay-01" title="{{isset($item->title) ? $item->title : null}}" />
                                    </a>
                                </div>
                                <div class="td-meta-info-container">
                                    <div class="td-meta-align">
                                        <div class="td-big-grid-meta">
                                            @if (isset($item->groups->title))
                                                <a href="/blog/{{ isset($item->groups->url)?$item->groups->url:$item->groups->slug }}" class="td-post-category">{{$item->groups->title}}</a>                     
                                            @endif
                                            <h3 class="entry-title td-module-title"><a href="{{isset($item->url) ? $item->url : $item->slug}}" rel="bookmark" title="{{isset($item->title) ? $item->title : null}}">{{isset($item->title) ? $item->title : null}}</a></h3>
                                        </div>
                                        <div class="td-module-meta-info">
                                            <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="{{$item->created_at}}" >{{$item->created_at->format('d-m-y H:i')}}</time></span>                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                            
                        @endforeach
                    @endif
                     {{-- <div class="td_module_mx11 td-animation-stack td-big-grid-post-1 td-big-grid-post td-medium-thumb">
                        <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/uu-dai-len-doi-de-yeu-tang-data-khung-cho-samsung-galaxy-a03" rel="bookmark" class="td-image-wrap" title="Ưu đãi khi mua Samsung Galaxy A03: Lên đời dế yêu &#8211; Tặng data khủng trong 6 tháng!"><img width="533" height="261" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/Hoang-Ha-Mobile-4-533x261.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/Hoang-Ha-Mobile-4-533x261.png 533w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/Hoang-Ha-Mobile-4-324x160.png 324w" sizes="(max-width: 533px) 100vw, 533px"  alt="Hoàng Hà Mobile A03" title="Ưu đãi khi mua Samsung Galaxy A03: Lên đời dế yêu &#8211; Tặng data khủng trong 6 tháng!" /></a></div>
                        <div class="td-meta-info-container">
                           <div class="td-meta-align">
                              <div class="td-big-grid-meta">
                                 <a href="https://hoanghamobile.com/tin-tuc/category/khuyen-mai" class="td-post-category">Khuyến Mãi</a>                        
                                 <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/uu-dai-len-doi-de-yeu-tang-data-khung-cho-samsung-galaxy-a03" rel="bookmark" title="Ưu đãi khi mua Samsung Galaxy A03: Lên đời dế yêu &#8211; Tặng data khủng trong 6 tháng!">Ưu đãi khi mua Samsung Galaxy A03: Lên đời dế yêu &#8211; Tặng data khủng trong 6 tháng!</a></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="td_module_mx11 td-animation-stack td-big-grid-post-2 td-big-grid-post td-medium-thumb">
                        <div class="td-module-thumb"><a href="https://hoanghamobile.com/tin-tuc/gio-vang-dat-truoc-samsung-galaxy-s22-ultra" rel="bookmark" class="td-image-wrap" title="Giờ vàng đặt hàng Galaxy S22 Ultra, cơ hội sở hữu siêu phẩm chỉ với 22.222.222 đồng"><img width="533" height="261" class="entry-thumb" src="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/s22-ultra-22tr-08-533x261.png"  srcset="https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/s22-ultra-22tr-08-533x261.png 533w, https://cdn1.hoanghamobile.com/tin-tuc/wp-content/uploads/2022/02/s22-ultra-22tr-08-324x160.png 324w" sizes="(max-width: 533px) 100vw, 533px"  alt="s22 ultra 22tr-08" title="Giờ vàng đặt hàng Galaxy S22 Ultra, cơ hội sở hữu siêu phẩm chỉ với 22.222.222 đồng" /></a></div>
                        <div class="td-meta-info-container">
                           <div class="td-meta-align">
                              <div class="td-big-grid-meta">
                                 <a href="https://hoanghamobile.com/tin-tuc/category/khuyen-mai" class="td-post-category">Khuyến Mãi</a>                        
                                 <h3 class="entry-title td-module-title"><a href="https://hoanghamobile.com/tin-tuc/gio-vang-dat-truoc-samsung-galaxy-s22-ultra" rel="bookmark" title="Giờ vàng đặt hàng Galaxy S22 Ultra, cơ hội sở hữu siêu phẩm chỉ với 22.222.222 đồng">Giờ vàng đặt hàng Galaxy S22 Ultra, cơ hội sở hữu siêu phẩm chỉ với 22.222.222 đồng</a></h3>
                              </div>
                           </div>
                        </div>
                     </div> --}}
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            <!-- ./block -->					
         </div>
      </div>
   </div>
</div>
<div class="td-main-content-wrap td-container-wrap">
   <div class="td-container">
      <!-- content -->
      <div class="td-pb-row">
         <div class="td-pb-span8 td-main-content">
            <div class="td-ss-main-content">
               <!-- module -->
                @if (isset($items_prd) && count($items_prd) > 0)
                        @foreach ($items_prd as $key => $item)
                                @if ($key > 2)
                                    <div class="td_module_10 td_module_wrap td-animation-stack">
                                        <div class="td-module-thumb"><a href="{{isset($item->url) ? $item->url : $item->slug}}" rel="bookmark" class="td-image-wrap" title="{{isset($item->title) ? $item->title : null}}">
                                            <img width="218" height="150" class="entry-thumb" src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}"  srcset="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }} 218w, {{ isset($item->image)?\App\Library\Files::media($item->image) : null }} 100w" sizes="(max-width: 218px) 100vw, 218px"  alt="" title="{{isset($item->title) ? $item->title : null}}" /></a></div>
                                        <div class="item-details">
                                            <h3 class="entry-title td-module-title"><a href="{{isset($item->url) ? $item->url : $item->slug}}" rel="bookmark" title="{{isset($item->title) ? $item->title : null}}">{{isset($item->title) ? $item->title : null}}</a></h3>
                                            <div class="td-module-meta-info">
                                                <a href="{{isset($data->url) ? $data->url : $data->slug}}" class="td-post-category">{{$data->title}}</a>
                                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="{{$item->created_at}}" >{{$item->created_at->format('d-m-y H:i')}}</time></span>                                        
                                            </div>
                                            <div class="td-excerpt">
                                                {!! isset($item->description) ? $item->description : '' !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                        @endforeach
                @endif
               <!-- module -->
               <div class="page-nav td-pb-padding-side">
                  {{-- <span class="current">1</span>
                  <a href="2" class="page" title="2">2</a>
                  <a href="3" class="page" title="3">3</a>
                  <span class="extend">...</span><a href="61" class="last" title="61">61</a><a href="2" ><i class="td-icon-menu-right"></i></a>
                  <div class="clearfix"></div> --}}
               </div>
            </div>
         </div>
         <div class="td-pb-span4 td-main-sidebar">
            <div class="td-ss-main-sidebar">
               <div class="td_block_wrap td_block_2 td_block_widget tdi_3_233 td-pb-border-top td_block_template_1 td-column-1 td_block_padding" >
                  <div class="td-block-title-wrap">
                     <h4 class="block-title td-block-title"><span class="td-pulldown-size">BÀI VIẾT MỚI</span></h4>
                  </div>
                  <div id=tdi_3_233 class="td_block_inner">
                      @if (isset($data_new) && count($data_new) > 0)
                        @foreach ($data_new as $key => $item)
                            <div class="td-block-span12">
                                <div class="{{$key = 0 ? 'td_module_2 td_module_wrap td-animation-stack' : 'td_module_6 td_module_wrap td-animation-stack'}}">
                                    <div class="td-module-image">
                                        <div class="td-module-thumb"><a href="{{isset($item->url) ? $item->url : $item->slug}}" rel="bookmark" class="td-image-wrap" title="{{isset($item->title) ? $item->title : null}}">
                                            <img width="324" height="160" class="entry-thumb" src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" title="{{isset($item->title) ? $item->title : null}}" /></a></div>
                                        @if (isset($item->groups->title))
                                            <a href="/blog/{{ isset($item->groups->url)?$item->groups->url:$item->groups->slug }}" class="td-post-category">{{$item->groups->title}}</a>
                                        @endif
                                    </div>
                                    <h3 class="entry-title td-module-title"><a href="{{isset($item->url) ? $item->url : $item->slug}}" rel="bookmark" title="{{isset($item->title) ? $item->title : null}}">{{isset($item->title) ? $item->title : null}}</a></h3>
                                    <div class="td-module-meta-info">
                                        <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="{{$item->created_at}}" >{{$item->created_at->format('d-m-y H:i')}}</time></span>                            
                                    </div>
                                    <div class="td-excerpt">
                                        {{isset($item->description) ? $item->description : null}}           
                                    </div>
                                </div>
                            </div>
                        @endforeach
                      @endif
                  </div>
               </div>
               <!-- ./block -->                            
            </div>
         </div>
      </div>
      <!-- /.td-pb-row -->
   </div>
   <!-- /.td-container -->
</div>
<!-- /.td-main-content-wrap -->
@endsection
