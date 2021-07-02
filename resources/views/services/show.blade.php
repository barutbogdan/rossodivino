@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/service.css') }}">
@endpush

@section('title', $serviceCategory->seo_title)
@section('meta_keywords', $serviceCategory->seo_keywords)
@section('meta_description', $serviceCategory->seo_description)

@section('breadcrumb')
	@include('partials.breadcrumb', [
		'title' => $serviceCategory->getTranslation()->seo_title,
		'parts' => [$page, $serviceCategory],
		'link'	=>	$serviceCategory->getTranslation()->path,
	])
@endsection

@section('content')
<div class="service-section">
		<div class="top-section">
			<h2 class="title-1">{!! $serviceCategory->getTranslation()->seo_title !!}</h2>
			<p class="text text-16 my-4">{!! $serviceCategory->getTranslation()->seo_description !!}</p>
			<div class="service-slide owl-carousel mb-4">
			
				@foreach($services as $service)
				<div class="item">
					<a class="d-flex magnific" href="{{asset('upload/'.$service->image)}}" title="Galeries photos - Top Sol - Sol ">
						<img class="img-fluid" src="{{asset('upload/'.$service->image)}}" alt="Galeries photos - Top Sol - Sol " />
						<div class="r-zoom"><i class="fa fa-plus"></i></div>
					</a>
				</div>
				@endforeach
				
				@if($realisationCategory)
					@foreach($realisationCategory->realisations as $realisation)
					<div class="item">
						<a class="d-flex magnific" href="{{asset('upload/'.$realisation->image)}}" title="Galeries photos - Top Sol - Sol ">
							<img class="img-fluid" src="{{asset('upload/'.$realisation->image)}}" alt="Galeries photos - Top Sol - Sol "/>
							<div class="r-zoom"><i class="fa fa-plus"></i></div>
						</a>
					</div>
					@endforeach
				@endif
		</div>
			<div class="text text-16">
				{!! $serviceCategory->getTranslation()->description !!}
			</div>

		</div>

		
</div>
			

@endsection

@push('scripts')
	
	<script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
	<script src="{{ elixir('js/pages/service.js') }}"></script>
@endpush