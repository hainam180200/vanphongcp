@if (isset($data) && count($data) > 0)
<section>
   <div class="container">
      <div class="box-product-home box-home">
         <div class="header">
            <h4><a href="#">{{setting('sys_name_widget_2')}}</a></h4>
         </div>
         <div class="col-content lts-product">
            @foreach ($data as $key => $item)
            <div class="item">
               <div class="img">
                  <a href="{{isset($item->item->url) ? $item->item->url : $item->item->slug}}" title="{{isset($item->item->title) ? $item->item->title : null}}">
                  <img src="{{ isset($item->item->image)?\App\Library\Files::media($item->item->image) : null }}" alt="{{isset($item->item->title) ? $item->item->title : null}}" class="img-fluid">
                  </a>
               </div>
               @if (isset($item->item->percent_sale) && (int)$item->item->percent_sale > 0)
                  <div class="cover">
                     <div style="color: yellow;
                        background: #f63;
                        margin: 25px 20px 15px 15px;
                        padding: 3px;
                        border-radius: 6px;
                        font-size:10px;
                        font-weight: 600;">
                        <span style="color:white">Khuyến mại giá sốc </span><br>
                        <span style="color:yellow"> {{number_format($item->item->price)}} đ</span><br>
                     </div>
                  </div>
               @endif
               <div class="info">
                  <a href="{{isset($item->item->url) ? $item->item->url : $item->item->slug}}" class="title" title="{{isset($item->item->title) ? $item->item->title : null}}">{{isset($item->item->title) ? $item->item->title : null}}</a>
                  <span class="price">
                  <strong>{{number_format($item->item->price)}} ₫</strong>
                  @if (isset($item->item->percent_sale) && (int)$item->item->percent_sale > 0)
                    <strike>{{number_format($item->item->price_old)}} ₫</strike>
                  @endif
                  </span>
               </div>
                @if (isset($item->item->promotion) && $item->item->promotion != "")
                    @if(count(json_decode($item->item->promotion)) > 0 )
                        <div class="note">
                            <span class="bag">KM</span> <label title="{{json_decode($item->item->promotion)[0]}}">{{\Str::limit(json_decode($item->item->promotion)[0],32)}}</label>
                            @if(count(json_decode($item->item->promotion)) > 1)
                                <strong class="text-orange">VÀ {{count(json_decode($item->item->promotion)) - 1}} KM KHÁC</strong>
                            @endif
                        </div>
                    @endif
                @endif
               @if (isset($item->item->promotion) && $item->item->promotion != "")
                    @if(count(json_decode($item->item->promotion)) > 0 )
                  <div class="promote">
                     <a href="{{isset($item->item->url) ? $item->item->url : $item->item->slug}}">
                        <ul>
                           @foreach (json_decode($item->item->promotion) as $item)
                           <li><span class="bag">KM</span> {{$item}}</li>
                           @endforeach
                        </ul>
                     </a>
                  </div>
               @endif
               @endif
            </div>
            @endforeach
         </div>
      </div>
   </div>
</section>
@endif
