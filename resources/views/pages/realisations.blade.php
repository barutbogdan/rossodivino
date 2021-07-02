@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/realisations.css') }}">
@endpush
@push('scripts')
	<script src="{{ elixir('js/pages/realisations.js') }}"></script>
    <script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
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
	<section class="realisations-section">
		<div class="top-services">
			<h2 class="title-1">{!! $page->getTranslation()->seo_title !!}</h2>
			<div class="text text-16 mt-4 mb-3">{!! $page->getTranslation()->description !!}</div>
		</div>

		<div class="realisation-categories">
			<div class="realisation-products owl-carousel">
				@foreach($categories as $k=>$category)
				<div class="item">
					<a class="d-block" data-tab="tab-{{$k}}"  title="{{$category->getTranslation()->name}}">
					{{$category->getTranslation()->name}}
					</a>
				</div>
				@endforeach
			</div>
		</div>			
		<div class="low-container">

			@foreach($categories as $key=>$category)
				<div id="tab-{{$key}}" class="tab-content">
					<div class="realisation-products-carousel owl-carousel">
					@foreach($groupedRealisations[$key] as $group)
						<div class="item">
							<div class="d-flex" style="flex-wrap:wrap;">
								@foreach($group as $k=>$r)
								<div class="col-6 col-md-4 mb-4">
									<a class="magnific d-flex" href="{{asset('upload/'.$r->image)}}" title="{{$r->getTranslation()->name}}">
										<img class="img-fluid" src="{{asset('upload/'.$r->image)}}" alt="{{$r->getTranslation()->name}}" />
										<div class="r-zoom"><i class="fa fa-plus"></i></div>
									</a>
								</div>
								@endforeach
							</div>
						</div>
					@endforeach
					</div>
				</div>
			@endforeach
		</div>
	</section>
@endsection

@push('scripts')
	<script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
	<script src="{{ elixir('js/pages/realisations.js') }}"></script>
@endpush