@if($services)
	<section class="services-section section" style="background:#fff0e9;">
		<div class="container custom-container">
			<div class="row">
				<div class="col-md-12 heading">
					@if($servicesPage = page('ServiceController'))
    					<h2 class="main-title">{{$servicesPage->getTranslation()->short_description}}</h2>
					@endif
				</div>
                @if($services->count())
                    @foreach($services->chunk(3) as $services)
                        @foreach($services as $service)
                            <div class="col-lg-4 area">
                                <div class="content">
                                	<div class="image" style="background:url( {{asset('/upload/'.$service->image)}} ) no-repeat center center;"></div>
                                    <div class="description">
                                    	<h2>{{ $service->getTranslation()->name }}</h2>
                                    	<p>{{ $service->getTranslation()->short_description }}</p>
                                    	@if($servicesPage = page('ServiceController'))
                                            <a href="{{ $servicesPage->path }}" title="{{ $service->getTranslation()->name }}" class="main-btn black">
                                               {{trans('homepage.view')}}
                                            </a>
                                        @endif
                                   </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif
