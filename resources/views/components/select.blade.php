
<div class="form-group">
    <label>{{$label}}</label>
        <select 
            class="form-control select2" 
            style="width: 100%;" 
            name="{{$name}}"
            data-placeholder="Select a {{$label}}"
        >

            <option value=""></option>

            @foreach($options as $option)

                <option 
                    value="{{$option->id}}"
                    @if( $option->id == $value)
                    selected='selected'
                    @endif

                >
                    {{$option->name}}
                </option>
                
            @endforeach
            
        </select>

        @if ($errors->has($name))
            <span class="text-danger">{{ $errors->first($name) }}</span>
        @endif
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.select2').select2();
    });
</script>