<div class="single-hero-slide"
     style="background-image: url({{ \App\Helper::getSliderImage( $slider->image )  }})">
    <div class="slide-content h-100 d-flex align-items-center">
        <div class="slide-text">
            <h4 class="text-white mb-0" data-animation="fadeInUp" data-delay="100ms"
                data-duration="1000ms">{{$slider->title ?? ''}}</h4>
            <p class="text-white" data-animation="fadeInUp" data-delay="400ms"
               data-duration="1000ms">{{$slider->subtitle ?? ''}}</p>
            @if(isset($slider->action))
                <a class="btn btn-primary btn-sm" href="{{ $slider->action ?? '#' }}"
                   data-animation="fadeInUp" data-delay="800ms"
                   data-duration="1000ms">Buy Now</a>
            @endif
        </div>
    </div>
</div>
