@if (isset($data) && count($data) > 0)
    @foreach ($data as $key => $item)
        <section>
            <div class="news-home box-home">
            <div class="header">
                <h4><a href="#">{{isset($item->title) ? $item->title : null}}</a></h4>
            </div>
            <div class="scroll">
                <div class="col-content  scroll-x">
                    @if (isset($item->items_index) && count($item->items_index) > 0)
                        @foreach ($item->items_index as $key_prd => $item_prd)
                            @if ($key_prd < 6)
                                <div class="item">
                                    <div class="img">
                                    <a href="{{isset($item_prd->url) ? $item_prd->url : $item_prd->slug}}"><img src="{{ isset($item_prd->image)?\App\Library\Files::media($item_prd->image) : null }}"></a>
                                    </div>
                                    <p>
                                    <a href="{{isset($item_prd->url) ? $item_prd->url : $item_prd->slug}}">{{isset($item_prd->title) ? $item_prd->title : null}}</a>
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            </div>
        </section>
    @endforeach
@endif