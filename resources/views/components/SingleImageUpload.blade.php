<div class="form-group">

    <div class="form-group">

        <label for="customFile">{{ $label }}</label>

        <div class="position-relative mb-2" id="img-box">
            <div class="position-relative d-inline-block">
                <img 
                    id='image' 
                    class="img-fluid" 
                    style='max-height:200px;'
                    src={{ asset($image)}}
                    
                >

                <button 
                    type='button' 
                    class="btn badge badge-danger position-absolute" 
                    id='cls-btn' 
                    style="top: -5px;right:-5px;display:none"
                    data-toggle="tooltip" 
                    data-placement="top"
                    title="Delete Image"
                >
                    X
                </button>

            </div>
        </div>

        <div class="custom-file">
            <input 
                type="file" 
                class="custom-file-input" 
                id="customFile"
                name='image'
            >
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>

    @if ($errors->has('images'))
        <span class="text-danger">{{ $errors->first('images') }}</span>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {



        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); 
            }
        }

        $("#customFile").change(function() {
            $('#preview-box').css('display','block')
            $("#cls-btn").css('display','block')
            readURL(this);
        });

        $("#cls-btn").click(function() {
            {{-- console.log('bal') --}}
            $("#customFile").val(null);
            $('#image').attr('src','{{ asset($image) }}')
            $(this).css('display','none')
        });
    });
</script>