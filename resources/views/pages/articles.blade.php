@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ elixir('css/pages/articles.css') }}">
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
	@if($articles->count())
	<div class="blog-section section">
	<div class="top-section">
			<h2 class="title-1">{!! $page->getTranslation()->seo_title !!}</h2>
			<p class="text text-16 mt-4 mb-3">{!! $page->getTranslation()->seo_description !!}</p>
		</div>
		
			<div class="blog-carousel owl-carousel">
			@foreach($articles as $article)
				<div class="item">
						<div class="top">
							<a class="d-block" href="{{$article->path}}" title="{{ $article->getTranslation()->name}}">
								@if($article->image_path)	
								<img class="img-fluid" src="{{asset('upload/'.$article->image)}}" title="" />
								@endif
								<div class="r-zoom"><i class="fa fa-plus"></i></div>
								</a>
							<div>
								<h3 style="-webkit-box-orient: vertical">{!! nl2br($article->getTranslation()->name) !!}</h3>
								<p class="text white mt-3">{!! nl2br($article->getTranslation()->seo_description) !!}</p>
							</div>
						</div>
						<a class="main-btn radius mt-3 back-content" href="{{$article->path}}" title="">{{trans('general.see-more')}}</a>
					</div>
				@endforeach
			</div>
		
	</div>
    @else
	<div class="blog-section section">
		<p class="no-blog-articles">Nous reviendrons bientôt avec notre article!</p>
	</div>
    @endif
@endsection

@push('scripts')
<script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
    <script src="{{ elixir('js/pages/articles.js') }}"></script>
@endpush
