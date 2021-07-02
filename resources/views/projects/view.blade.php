@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ elixir('css/pages/project.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/pages/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fancybox/jquery.fancybox.min.css') }}">
    
    <meta property="og:type"   content="website" />

	<meta property="og:image" content="{{ $project->images[0]->path }}?fbrefresh=121213"/>
	
	<meta property="og:title" content="{{ $project->getTranslation()->name }}"/>
	<meta property="og:url" content="{{ $project->path }}" />
	<meta property="og:description" content="{{ strip_tags($project->getTranslation()->description) }}"/>
@endpush



@section('title', $project->seo_title)
@section('meta_keywords', $project->seo_keywords)
@section('meta_description', $project->seo_description)

@section('breadcrumb')
	@include('partials.breadcrumb', [
        'title' => $project->getTranslation()->name,
        'parts' => [$page, $project],
        'image' => $page->image,
    ])
@endsection

@section('content')
	<section class="project-section section">
		<div class="container main-container">
			<div class="row">
				<div class="col-lg-4 left-side text-center">
					<ul>
						@foreach($projects as $p)
							<li>
								<a href="{{$p->path}}" title="{{$p->getTranslation()->name}}">
									{{$p->getTranslation()->name}}<i class="fa fa-arrow-right" aria-hidden="true"></i>
								</a>
							</li>
						@endforeach
					</ul>
				</div>
				<div class="col-lg-8 right-side">
					<div class="project-slider owl-carousel" id="sync1">
						@if($project->images->count())
							@foreach($project->images as $k=>$image)
    							<div class="item">
    								<a href="{{$image->path}}" title="{{$image->name}}" class="fancy-gallery" data-fancybox="gallery">
       									<img src="{{ $image->path }}" alt="{{ $image->name }}">
       								</a>
    							</div>
    						@endforeach
       					@endif
					</div>
					<h2>{{$project->getTranslation()->name}}</h2>
					<div class="txt">
						{!! nl2br($project->getTranslation()->description) !!}
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
    <script src="{{ elixir('js/pages/project.js') }}"></script>
    <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
    
     <script>
		$(document).ready(function(){
			$(".fancy-gallery").fancybox();
		});

    </script>
@endpush
