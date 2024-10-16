@if (isset($data) && count($data) > 0)
    <section>
        <div class="box-product-home box-home">
            <div class="header">
                <h4><a href="#">{{setting('sys_name_widget_2')}}</a></h4>
            </div>
            <div class="lts-product col-product">
                @foreach ($data as $key => $item)
                    <div class="item">
                        <div class="img">
                            <a href="{{isset($item->item->url) ? $item->item->url : $item->item->slug}}" title="{{isset($item->item->title) ? $item->item->title : null}}">
                            <img src="{{ isset($item->item->image)?\App\Library\Files::media($item->item->image) : null }}" alt="{{isset($item->item->title) ? $item->item->title : null}}" class="img-fluid">
                            </a>
                        </div>
                        {{-- <div class="sticker sticker-left">
                            <span><img src="/assets/frontend/image/apple.png" title="Ch&#237;nh h&#227;ng Apple" /></span>
                        </div> --}}
                        @if (isset($item->item->percent_sale) && (int)$item->item->percent_sale > 0)
                            <span class="sales">
                                <i class="fas fa-bolt"></i> Giảm {{number_format($item->item->price - $item->item->price_old)}} ₫
                            </span>
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
    </section>
@endif
