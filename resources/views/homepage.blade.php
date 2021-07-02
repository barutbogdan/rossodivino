@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ elixir('css/pages/homepage.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/lc-lightbox/lc_lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/lc-lightbox/minimal.css') }}">
@endpush

@section('title', $welcome->seo_title)
@section('meta_keywords', $welcome->seo_keywords)
@section('meta_description', $welcome->seo_description)

@php
	$servicePage = page('ServicesController');
	$articlesPage = page('ArticlesController')
@endphp

@section('content')

<section class="top-section">
	<h1 class="title-1 text-center text-md-left">
		<span>{{trans('hero.title')}}</span>
	</h1>
	<p class="subtitle-300 mb-2 mt-3 text-center text-md-left">{{trans('hero.subtitle')}}</p>
	<p class="text text-center text-md-left">{{trans('hero.text')}}</p>
</section>

<section class="blue-section mt-3 mt-md-5">
	<h2 class="title-2 white text-center text-md-left">{{trans('blue-section.title')}}</h2>
	<div class="inner mt-2">
		<img src="img/quick-fr.png" alt="{{trans('blue-section.title')}}" />
		<div>
			<p class="text medium white mb-3">{{trans('blue-section.text-1')}}</p>
			<p class="text medium white">{{trans('blue-section.text-2')}}</p>
			<p class="text medium white">{{trans('blue-section.text-3')}}</p>
		</div>
	</div>
</section>
<section class="products-section">
	<div class="inner">
		<h3>{{ $servicePage->getTranslation()->name }}</h3>
		<div class="home-products owl-carousel">
			@foreach($serviceCategories as $serviceCategory)
			<div class="item">
				<h2>
					<a class="back-content" href="{{$serviceCategory->path}}" title="{{$serviceCategory->getTranslation()->name}}">
					{{$serviceCategory->getTranslation()->name}}
					</a>
				</h2>
			</div>
			@endforeach
		</div>
	</div>
</section>

@if($articles)
<section class="articles-section">
	<div class="inner">
		<div class="article-heading">
			<h2>{{ $articlesPage->getTranslation()->name }}</h2>
			<p class="text medium mt-3">{{ $articlesPage->getTranslation()->seo_description }}</p>
		</div>
		<div class="articles-slider owl-carousel">
			@foreach($articles as $article)
			<div class="item">
				<a class="back-content" href="{{$article->path}}" title="{{$article->getTranslation()->name}}" class="article">
					<div class="image">
						<img src="{{asset('upload/'.$article->image)}}" alt="{{$article->getTranslation()->name}}">
						<div class="r-zoom"><i class="fa fa-plus"></i></div>
					</div>
					<h2>{{$article->getTranslation()->name}}</h2>
				</a>
			</div>
			@endforeach	
		</div>
	</div>
</section>
@endif
<div class="home-copyright d-block d-md-none text medium white">
	<p>{{trans('footer.copyright_text')}}</p>	
</div>
	



@endsection

@push('scripts')
    <script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
    <script src="{{ asset('plugins/lc-lightbox/lc_lightbox.min.js') }}"></script>
    <script src="{{ elixir('js/pages/home.js') }}"></script>
@endpush
