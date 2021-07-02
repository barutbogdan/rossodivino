@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/about.css') }}">
@endpush

@section('title', $page->seo_title)
@section('og:title', $page->seo_title)
@section('meta_keywords', $page->seo_keywords)
@section('meta_description', $page->seo_description)
@section('og:description', $page->seo_description)

@section('breadcrumb')
	@include('partials.breadcrumb', [
		'title' => $page->getTranslation()->name,
		'parts' => [$page]
	])
@endsection

@section('content')
    <div class="about-us-section">
    	<div class="about-us">
    		<div class="container-fluid">
        		<div class="col-lg-6 offset-lg-6 big-img" {!! styleAttrImage($page) !!}></div>
        	</div>
        	<div class="cover-container container">
        		<div class="row">
        			<div class="col-lg-6">
        				<div class="heading">
        					<h2>{{ $page->getTranslation()->name }}</h2>
        					{!! $page->getTranslation()->description !!}
							@if($team = page('TeamController'))
        						<a class="main-btn small gray" href="{{ $team->path }}" title="{{ trans('about.meet_out_team') }}">{{ trans('about.meet_out_team') }}</a>
							@endif
        				</div>
        			</div>
        		</div>
        	</div>
    	</div>
    	<div class="company-statistics">
    		<div class="container">
    			<div class="row">
    				<div class="col-lg-12 col-md-12 col-sm-12 n">
    					<div class="heading">
    						<h2>{{ trans('about.company_statistics') }}</h2>
    					</div>
    				</div>
    				<div class="col-lg-3 col-md-6 col-sm-6 area">
    					<i class="sprite users"></i>
    					<span data-max="{{ settings('statistics_professionals_in_our_team') }}" id="value1">0</span>
    					<p>{{ trans('about.professionals_in_our_team') }}</p>
    				</div>
    				<div class="col-lg-3 col-md-6 col-sm-6 area">
    					<i class="sprite medal"></i>
    					<span data-max="{{ settings('statistics_years_of_successful_work') }}" id="value2">0</span>
    					<p>{{ trans('about.years_successful') }}</p>
    				</div>
    				<div class="col-lg-3 col-md-6 col-sm-6 area">
    					<i class="sprite face"></i>
    					<span data-max="{{ settings('statistics_satisfied_clients') }}" id="value3">0</span>
    					<p>{{ trans('about.satisfied_clients') }}</p>
    				</div>
    				<div class="col-lg-3 col-md-6 col-sm-6 area">
    					<i class="sprite check"></i>
    					<span data-max="{{ settings('statistics_projects_done') }}" id="value4">0</span>
    					<p>{{ trans('about.projects_done') }}</p>
    				</div>
    			</div>
    		</div>
    	</div>
		@if($teams->count())
    	<div class="blog-articles">
    		<div class="container">
    			<div class="row">
					@foreach($teams as $team)
						<div class="col-md-4 col-sm-6">
							<div class="content">
								@if($image_path = $team->image_path)
									<a title="{{ $team->getTranslation()->name }}">
										<img src="{{ $image_path }}" alt="{{ $team->getTranslation()->name }}">
									</a>
								@endif
								<div>
									<a title="{{ $team->getTranslation()->name }}" class="head">
										{{ $team->getTranslation()->name }}
									</a>
									<p>{{ $team->getTranslation()->short_description }}</p>
								</div>
							</div>
						</div>
					@endforeach
    			</div>
    		</div>
    	</div>
		@endif
    	@include('partials.request_service.simple')
	</div>
@endsection

@push('scripts')
	<script src="{{ elixir('js/pages/about.js') }}"></script>
@endpush