@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/services.css') }}">
@endpush

@section('title', $page->seo_title)
@section('og:title', $page->seo_title)
@section('meta_keywords', $page->seo_keywords)
@section('meta_description', $page->seo_description)
@section('og:description', $page->seo_description)

@section('breadcrumb')
    @include('partials.breadcrumb', [
        'title' => $page->getTranslation()->seo_title,
        'parts' => [$page],
        'image' => $page->image,
		'link'	=>	$page->path
	])
@endsection

@section('content')
   
   @if($services)
        <section class="services-section section">
			<div class="top-services">
				<h2 class="title-1">{!! $page->getTranslation()->seo_title !!}</h2>
				<p class="text text-16 mt-4 mb-3">{!! $page->getTranslation()->seo_description !!}</p>
				<div class="text text-16">
					{!! $page->getTranslation()->description !!}
				</div>
			</div>
			<section class="products-section">
				<div class="inner">
					<div class="home-products owl-carousel">
						@foreach($serviceCategories as $k=>$serviceCategory)
						<div class="item">
							<a data-tab="tab-{{$k}}"  title="{{$serviceCategory->getTranslation()->name}}">
							{{$serviceCategory->getTranslation()->name}}
							</a>
						</div>
						@endforeach
					</div>

					@foreach($serviceCategories as $k=>$serviceCategory)
						<div id="tab-{{$k}}" class="tab-content">
							<div class="tab-inner">
								<div class="left">
									@if($serviceCategory->image)
									<img src="{{asset('upload/'.$serviceCategory->image)}}" alt="{{$serviceCategory->getTranslation()->name}}" />
									@endif
								</div>
								<div class="right">
									<h4 class="title-2 white">
										{{$serviceCategory->getTranslation()->name}}
									</h4>
									<p class="text text-16 white my-4">{!! $serviceCategory->getTranslation()->seo_description !!}</p>
									<p class="text text-16 white mb-4">{!! $serviceCategory->getTranslation()->short_description !!}</p>
									<a class="main-btn radius back-content" href="{{$serviceCategory->path}}" title="{{$serviceCategory->getTranslation()->name}}">{{trans('general.see-more')}}</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</section>
        </section>
    @endif
@endsection

@push('scripts')
	<script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
	<script src="{{ elixir('js/pages/service.js') }}"></script>
@endpush