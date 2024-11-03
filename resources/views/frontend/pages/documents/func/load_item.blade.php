<p class="fw-600">Tổng số: {{isset($items) && count($items) > 0 ? count($items) : 0}}</p>
<div class="table-responsive" id="tableacchstory">
    <table class="table table-hover table-custom-res">
        <thead>
        <tr>
            <th>Số hiệu văn bản</th>
            <th>Ngày ban hành</th>
            <th>Trích yếu</th>
            <th>Tệp đính kèm</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($items) && count($items) > 0)
        @foreach($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>

                    {{isset($item) ? $item->created_at->format('d/m/Y') : ''}}
                </td>
                <td>
                    <a href="{{isset($item->url) ? $item->url : $item->slug}}">{{$item->title}}</a>
                    <br>
                    <span class="fz-12 font-italic" style="opacity: 0.8">Lượt xem: {{$item->totalviews ?? 0}}</span>
                </td>

                <td>
                    <a download="{{ isset($item) && $item->pdf_file ? basename($item->pdf_file) : '' }}"
                       href="{{\App\Library\Files::media($item->pdf_file)}}" id="fileNameText">
                        {{ isset($item) && $item->pdf_file ? 'Tải về' : '' }}
                    </a>

                </td>
            </tr>
        @endforeach
        @else
            <tr><td >Không có văn bản nào</td> </tr>
        @endif
        </tbody>
    </table>
</div>
<div class="col-md-12 left-right justify-content-end paginate__v1 paginate__v1_mobie frontend__panigate">

    @if (isset($items))
        @if ($items->total() > 1)
            <div class="row marinautooo paginate__history paginate__history__fix justify-content-center">
                <div class="col-auto paginate__category__col">
                    <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                        {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
