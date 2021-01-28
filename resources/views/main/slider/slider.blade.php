
@php 
    $images = [
        'images/sections/slider/1.jpg',
        'images/sections/slider/2.jpg',
        'images/sections/slider/3.jpg',
        'images/sections/slider/4.jpg',
    ]; 
@endphp

<!-- data-interval="false" -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
  <ol class="carousel-indicators">
    @foreach ($images as $image)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
        @foreach($images as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img class="" src="{{ asset($image) }}">
            </div>
        @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>