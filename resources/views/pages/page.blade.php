@extends('layouts.web.default')

@section('title', $page->seo_title)
@section('og:title', $page->seo_title)
@section('meta_keywords', $page->seo_keywords)
@section('meta_description', $page->seo_description)
@section('og:description', $page->seo_description)

@section('breadcrumb')
	@include('partials.breadcrumb', [
		'title' => $page->getTranslation()->name,
		'parts' => [$page],
		'image' => $page->image
	])
@endsection

@section('content')
	<section id="page">
        <div class="container custom-container">
            <div class="row">
            	<div class="col-md-12">
                    <div class="main-description">
                        <div class="text">{!! $page->getTranslation()->description !!}</div>
                    </div>
        		</div>
        	</div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/pages.css') }}">
@endpush
