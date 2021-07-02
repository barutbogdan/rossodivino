@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/ambasador.css') }}">
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
    <section class="ambasador-section">
		<h2 class="title-1 mb-3">{!! $page->getTranslation()->seo_title !!}</h2>
        {!! $page->getTranslation()->description !!}
    </section>
@endsection

@push('scripts')
	<script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
	<script src="{{ elixir('js/pages/ambasador.js') }}"></script>
@endpush