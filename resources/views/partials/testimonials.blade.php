<div class="testimonial-section">
    <div class="container">
        <div class="row">
            @if($testimonials->count())
                <div class="col-lg-12 col-md-12 side">
                    <div class="heading">
                        <h3>{{ trans('homepage.testimonials') }}</h3>
                    </div>
                    <div class="testimonial-slider owl-carousel">
                        @foreach($testimonials as $testimonial)
                            <div class="item">
                                <h5></h5>
                                <p>{!! nl2br($testimonial->getTranslation()->description) !!}</p>
                                <h4>{{ $testimonial->getTranslation()->name }}, {{ $testimonial->getTranslation()->profession }}</h4>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
