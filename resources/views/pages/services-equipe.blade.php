@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/services-equipe.css') }}">
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
		'link' => $page->path
	])
@endsection

@section('content')
        <section class="equipe-section">
            <h2 class="title-1">{!! $page->getTranslation()->seo_title !!}</h2>
            <p class="text text-16 mt-4 mb-3">{!! $page->getTranslation()->seo_description !!}</p>
            <div class="text text-16">
            {!! $page->getTranslation()->description !!}
            </div>
        </section>

        <div class="row equipe-images">
        @foreach($servicesImages as $s)
            <div class="col-lg-4 col-md-3 col-sm-6 mb-4">
                <div class="item">
                    <a href="{{ $s->path}}" class="magnific">
                        <div class="image" style="background:url('{{ $s->path }}')no-repeat center center / cover">
                            <div class="r-zoom"><i class="fa fa-plus"></i></div>
                        </div>
                        <h3 class="title-4 colored mt-2">{{ $s->getTranslation()->name}}</h3>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
    <script src="{{ elixir('js/pages/services-equipe.js') }}"></script>
@endpush