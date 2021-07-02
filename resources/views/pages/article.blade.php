@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ elixir('css/pages/article.css') }}">
@endpush

@php
	$articlesPage = page('ArticlesController')
@endphp


@section('title', $article->seo_title)
@section('og:title', $article->seo_title)
@section('meta_keywords', $article->seo_keywords)
@section('meta_description', $article->seo_description)
@section('og:description', $article->seo_description)

@section('breadcrumb')
	@include('partials.breadcrumb', [
        'title' => $article->getTranslation()->seo_title,
        'parts' => [$page, $article],
        'image' => $page->image,
        'link'	=>	$page->path
    ])
@endsection

@section('content')
<section class="article-section">
	<h2 class="title-1">{!! $article->getTranslation()->seo_title !!}</h2>
	<p class="text text-16 mt-4 mb-5">{!! $article->getTranslation()->seo_description !!}</p>
	<div class="article-content">
		@if($article->image_path)
			<div class="image">
				<a class="d-block position-relative" title="{{ $article->getTranslation()->name }}" class="magnific-project">
					@if($article->image_path)
						<img class="img-fluid" src="{{ $article->image_path }}" alt="{{ $article->getTranslation()->name }}">
					@endif
				</a>

			</div>
		@endif
		<div class="details">
			<div class="date">
				<span>{{$article->published_at->format('d.M.Y')}}</h2>

			</div>
			<div class="description text text-16">
				{!! nl2br( $article->getTranslation()->description ) !!}
			</div>
		</div>
	</div>
	<div class="controllers d-flex justify-content-between">
		@if($prev)
			<a class="text text-16 medium back-content" href="{{ str_replace(' ', '-',$prev->getTranslation()->slug)}}" title="{{$prev->getTranslation()->name}}">
				<i class="fas fa-chevron-left"></i>
				{{trans("general.prev")}}
			</a>
		@endif

		<a class="text text-16 medium back-content" href="{{$articlesPage->path}}" title="">Toutes les conseils</a>

		@if($next)
			<a class="text text-16 medium back-content" href="{{ str_replace(' ', '-',$next->getTranslation()->slug)}}" title="{{$next->getTranslation()->name}}">
				{{trans("general.next")}}
				<i class="fas fa-chevron-right"></i>
			</a>
		@endif
	</div>
</section>


@endsection

@push('scripts')
	<script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
    <script src="{{ elixir('js/pages/article.js') }}"></script>
@endpush
