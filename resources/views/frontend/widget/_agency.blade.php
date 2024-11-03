@if(isset($data) && count($data) > 0)
<div class="article-default c-mb-12">
    <div class="article-header w-100">
        <a href="">
            Cơ quan ban hành
        </a>
    </div>
    <div class="article-content c-mt-12">

        <div class="article-content-item c-px-12">
            @foreach($data as $key => $item)
                <div class="article-content-arrow c-mb-6">
                    {{$item->title}}
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
