@if (isset($data) && count($data) > 0)
    <!-- flash sales -->
    <section>
        <div class="container">
        <div class="flash-sales">
            <div class="header">
                <h3>F<i class="fas fa-bolt" style="padding: 0 4px;color: #f63"></i>ASH SALE ONLINE</h3>
                {{-- <div class="timer" id="timer" data-start="January 14, 2022 23:32:30" data-end="January 16, 2022 00:00:00"></div> --}}
            </div>
            <div class="content scroll">
                <div class="product-list scroll-x equaHeight" data-obj=".item a.title">
                    @foreach ($data as $key => $item)
                        <div class="item">
                            <div class="img">
                                <a href="{{isset($item->item->url) ? $item->item->url : $item->item->slug}}" title="{{isset($item->item->title) ? $item->item->title : null}}" target="{{isset($item->item->target) && $item->item->target == 1 ? '_blank' : null}}">
                                    <img src="{{ isset($item->item->image)?\App\Library\Files::media($item->item->image) : null }}" alt="{{isset($item->item->title) ? $item->item->title : null}}" class="img-fluid">
                                </a>
                            </div>
                            <div class="info">
                                <a class="title" href="{{isset($item->item->url) ? $item->item->url : $item->item->slug}}">{{isset($item->item->title) ? $item->item->title : null}}</a>
                                <span class="price">
                                <strong>{{number_format($item->item->price)}} ₫</strong>
                                @if (isset($item->item->percent_sale) && (int)$item->item->percent_sale > 0)
                                    <strike>{{number_format($item->item->price_old)}} ₫</strike>
                                @endif
                                </span>
                                {{-- <div class="deal-status">
                                    <div class="p-order-status w-100">
                                        <span class="text">Còn lại</span>
                                        <span class="bg-count-left" style="width: 100%"></span>
                                        <span class="icon-order-status icon-order-status-deal" style="left: 100%"></span>
                                    </div>
                                </div> --}}
                                @if (isset($item->item->is_point) && $item->item->is_point == 1)
                                    <div class="deal-status">
                                        <div class="p-order-status w-100">
                                            <span class="text">Còn lại:</span>
                                            <span class="bg-count-left" style="width: 100%;color: #fff;"><b style="padding-left: 15px">{{isset($item->item->number_point) ? $item->item->number_point : "100" }}</b></span>
                                            <span class="icon-order-status icon-order-status-deal" style="left: 100%"></span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>
@endif
