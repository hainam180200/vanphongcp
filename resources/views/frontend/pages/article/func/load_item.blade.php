@if(isset($items_prd) && count($items_prd) > 0)
    @foreach($items_prd as $item)
        <div class="news-item row c-mb-20" >
            <div class="col-lg-4">
                <div class="news-image w-100">
                    <a href="{{isset($item->url) ? $item->url : $item->slug}}" class="d-flex">
                        <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" loading="lazy" class="w-100 brs-4">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 c-pl-4 c-py-8">
                <div class="news-times font-italic text-right">
                    {{isset($item) ? $item->created_at->format('d/m/Y') : ''}}

                </div>
                <div class="news-header t-sub-3">
                    <a href="{{isset($item->url) ? $item->url : $item->slug}}">
                        {{$item->title}}
                    </a>
                </div>
                <div class="news-text text-limit limit-3 t-body-1">
                    {{$item->description}}
                </div>
            </div>
        </div>
    @endforeach
@else
    <tr><td >Không có văn bản nào</td> </tr>
@endif

<div class="col-md-12 left-right justify-content-end paginate__v1 paginate__v1_mobie frontend__panigate">

    @if (isset($items_prd))
        @if ($items_prd->total() > 1)
            <div class="row marinautooo paginate__history paginate__history__fix justify-content-center">
                <div class="col-auto paginate__category__col">
                    <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                        {{ $items_prd->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
