{{-- <div class="form-group {{ $errors->has($field['name']) ? ' text-danger' : '' }} ">
    <div class="fileinput {{ old($field['name'], setting($field['name']) ?? null)!=""?"fileinput-exists":"fileinput-new" }}" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px">
            <img src="/assets/backend/themes/images/empty-photo.jpg" alt="">
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail" style="width: 150px; height: 150px; line-height: 150px;">
            @if(old($field['name'], setting($field['name']) ?? null)!="")
                <img src="{{ old($field['name'], setting($field['name'])!=""?asset("/storage".setting($field['name'])):"/assets/backend/themes/images/empty-photo.jpg") }}">
            @endif
        </div>
        <div>
            <span class="btn default btn-file">
                <span class="fileinput-new"> Chọn {{mb_strtolower(__($field['label'])) }} </span>
                <span class="fileinput-exists"> {{__('Thay đổi')}} </span>
                <input type="file" name="{{$field['name']}}">
            </span>
            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{__("Xóa")}} </a>
        </div>
    </div>
    @if ($errors->has($field['name']))
        <span class="form-text text-danger">{{ $errors->first($field['name']) }}</span>
    @endif
</div> --}}

 <div class="form-group m-form__group {{ $errors->has($field['name']) ? ' text-danger' : '' }}">
    <label for="target" class="form-control-label">{{mb_strtolower(__($field['label']))}}</label><br>
    <div class="fileinput  {{ old($field['name'], setting($field['name']) ?? null)!=""?"fileinput-exists":"fileinput-new" }}" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
            <img src="/assets/backend/images/empty-photo.jpg" data-src="/assets/backend/images/empty-photo.jpg" alt="">
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail" style="width: 150px; height: 150px;">
            @if(old($field['name'], setting($field['name']) ?? null)!="")
            <img src="{{ old($field['name'], setting($field['name'])!=""?asset("/storage".setting($field['name'])):"/assets/backend/themes/images/empty-photo.jpg") }}">
            <input type="hidden" name="{{$field['name']}}_oldest" value="1">
            @endif
        </div>
        <div>
        <span class="btn btn-default btn-file">
            <span class="fileinput-new">Chọn {{mb_strtolower(__($field['label']))}}</span>
            <span class="fileinput-exists">Đổi {{mb_strtolower(__($field['label']))}}</span>
            <input type="file" name="{{$field['name']}}">
        </span>
        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
        </div>
    </div>
    @if ($errors->has($field['name']))
        <span class="form-text text-danger">{{ $errors->first($field['name']) }}</span>
    @endif
</div>
