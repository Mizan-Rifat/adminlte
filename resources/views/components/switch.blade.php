

<div class="custom-control custom-switch form-group" id='switchContainer'>
  <input 
    type="checkbox" 
    class="custom-control-input" 
    id="customSwitch1"
    @if($value == 1)
      checked
    @endif
  >
  
  <input 
    type="hidden"  
    id="hiddenInput" 
    name="{{$name}}"
    value='{{$value ?: 0 }}'
  >

  <label class="custom-control-label" id='custom-control-label' for="customSwitch1">{{$label}}</label>

  @if ($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
  @endif
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {

    $('#customSwitch1').change((e)=>{
      if(!e.target.checked){
          $('#hiddenInput').val(0); 
      }else{
        
          $('#hiddenInput').val(1);
      }
    })
     
     
  });
</script>