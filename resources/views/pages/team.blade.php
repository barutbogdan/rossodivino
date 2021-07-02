@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/team.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/homepage.css') }}">
@endpush

@section('title', $page->seo_title)
@section('og:title', $page->seo_title)
@section('meta_keywords', $page->seo_keywords)
@section('meta_description', $page->seo_description)
@section('og:description', $page->seo_description)

@section('breadcrumb')
	@include('partials.breadcrumb', [
        'title' => $page->getTranslation()->name,
        'parts' => [$page],
        'image' => $page->image,
    ])
@endsection

@section('content')
	@if($teams->count())
        <section class="team-section section white">
        	<div class="container custom-container">
        		<div class="row">
        			<div class="col-md-12 heading text-center">
        				<h2 class="main-title">{{$page->getTranslation()->short_description}}</h2>
        			</div>
        			@foreach($teams as $team)
        				<div class="col-lg-3 col-md-6 team">
        					<div class="profile">
        						<div class="image">
        							<img src="{{asset('/upload/'.$team->image)}}" alt="{{$team->getTranslation()->name}}">
        						</div>
        						<div class="info">
        							<h2>{{$team->getTranslation()->name}}</h2>
        							<h4>{{$team->getTranslation()->position}}</h4>
        							<ul class="socials">
                                        @if($facebook = settings('facebook'))
                                            <li>
                                                <a href="{{ $facebook }}" title="Facebook" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if($twitter = settings('twitter'))
                                            <li>
                                                <a href="{{ $twitter }}" title="Twitter" target="_blank">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if($linkedin = settings('linkedin'))
                                            <li>
                                                <a href="{{ $linkedin }}" title="Linkedin" target="_blank">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
        						</div>
        					</div>
        				</div>
        			@endforeach
        		</div>
        	</div>
    	</section>
    @endif
    @include('partials.newsletter')
@endsection

@push('scripts')
	<script src="{{ elixir('js/pages/team.js') }}"></script>
	<script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
@endpush
