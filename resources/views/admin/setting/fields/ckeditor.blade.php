


<div class="form-group {{ $errors->has($field['name']) ? ' text-danger' : '' }}">
    <label for="{{ $field['name'] }}" >{{ __($field['label']) }}:</label>
    <textarea id="ckeditor_{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control ckeditor-basic {{ Arr::get( $field, 'class') }}" data-height="150"  data-startup-mode="">{{ old($field['name'], setting($field['name'])) }}</textarea>
    @if ($errors->has($field['name']))
        <span class="form-text text-danger">{{ $errors->first($field['name']) }}</span>
    @endif
</div>
@section('scripts')
    @parent
<script>

    $(document).ready(function(){
        CKEDITOR.replace('ckeditor_{{ $field['name'] }}',{
            removeButtons: 'Source',
            // startupMode:'source',

        } );
    });
</script>
@stop
