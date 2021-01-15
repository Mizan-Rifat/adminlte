
<div class="form-group">
    <label>{{ $label }}</label>
    <select 
        class="form-control select2-{{ strtolower(str_replace(' ', '',$label)) }}" 
        multiple="multiple" 
        data-placeholder="Select {{$label}}"
        name="{{ $name }}[]"
        style="width: 100%;"
    >
        @foreach($options as $option)
            <option 
                value="{{$option['id']}}"
                @if( $value != null && in_array($option['id'],$value) )
                selected='selected'
                @endif
            >
                {{$option['name']}}
            </option>
        @endforeach

    </select>

    @if ($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {

        let vari = @json(strtolower(str_replace(' ', '',$label)));
        let id = '.select2-' + vari;
        let selector = $(id).select2();

    });
</script>