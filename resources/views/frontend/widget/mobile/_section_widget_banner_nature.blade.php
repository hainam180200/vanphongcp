@if (isset($data) && count($data) > 0)
    <section>
        <div class="container">
            <div class="corevalue">
                @foreach ($data as $item)
                    <div class="item">
                        <img src="{{ isset($item->image)?\App\Library\Files::media($item->image) : null }}" alt="{{isset($item->title) ? $item->title : null}}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif