<select id="provinces" name="provinces" placeholder="Tỉnh/Thành phố *" required>
    <option value="">Tỉnh/Thành phố *</option>

    @if (isset($data) && count($data) > 0)

        @foreach ($data as $item)
            <option value="{{$item->code}}">{{$item->name}}</option>
        @endforeach
    @endif
</select>
