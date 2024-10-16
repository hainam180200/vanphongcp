@if (isset($data))
    <section>
        <div class="container">
            <div class="ads">
                <a href="{{ isset($data->url)?$data->url:'' }}" target="{{isset($data->target) && $data->target == 1 ? '_blank' : null}}">
                    <img src="{{ isset($data->image)?\App\Library\Files::media($data->image) : null }}" style="width: 100%;" title="{{ isset($data->title)?$data->title:'' }}" />
                </a>
            </div>
        </div>
    </section>
@endif