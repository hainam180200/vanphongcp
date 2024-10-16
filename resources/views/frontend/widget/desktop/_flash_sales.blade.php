@if (isset($data) && count($data) > 0)
    <section>
        <div class="container">
        <div class="flash-sales">
            <div class="header">
                <h3>F<i class="fas fa-bolt" style="padding: 0 4px"></i>ASH SALE ONLINE</h3>
                {{-- @if (setting('sys_flash_sales_ended_at'))
                    <div class="timer" id="timer" data-start="December 25, 2021 14:49:17" data-end="December 27, 2021 00:00:00"></div>
                    {{dd(\App\Library\Helpers::FormatDateTimeToF(setting('sys_flash_sales_ended_at')))}}
                    <div class="timer" id="timer" data-start="{{\App\Library\Helpers::FormatDateTimeToF(\Carbon\Carbon::now()->toDateTimeString())}}" data-end="{{\App\Library\Helpers::FormatDateTimeToF(setting('sys_flash_sales_ended_at'))}}"></div>
                @endif --}}
            </div>
            <div class="content">
                <div class="owl-carousel equaHeight lr-slider" data-obj=".item a.title">
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
                                @if (isset($item->item->is_point) && $item->item->is_point == 1)
                                    <div class="deal-status">
                                        <div class="p-order-status w-100">
                                            <span class="text">Còn lại:</span>
                                            <span class="bg-count-left" style="width: 100%;color: #fff;font-weight:bold">{{isset($item->item->number_point) ? $item->item->number_point : "100" }}</span>
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
