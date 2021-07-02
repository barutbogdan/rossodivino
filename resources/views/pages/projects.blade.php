@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ elixir('css/pages/projects.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fancybox/jquery.fancybox.min.css') }}">
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

<section class="realisations-section">
		<div class="top-services">
			<h3 class>{!! $page->getTranslation()->heading !!}</h3>
			<p class="text text-16 mt-4 mb-3">{!! $page->getTranslation()->description !!}</p>
		</div>

		<div class="realisation-categories">
			<div class="realisation-products owl-carousel">
				@foreach($categories as $k=>$category)
				<div class="item">
					<a data-tab="tab-{{$k}}"  title="{{$category->getTranslation()->name}}">
					{{$category->getTranslation()->name}}
					</a>
				</div>
				@endforeach
			</div>
		</div>			

	</section>

	@if($projects)
        <div class="projects-section section">
            <div class="container main-container">
                <div class="row">
                    @foreach($projects as $project)
                        <div class="col-lg-4 col-md-6 col-sm-6 project text-center" data-category="{{reduce_model_categories_to_css_classes($project)}}">
                            <a href="{{ $project->path }}" title="{{ $project->getTranslation()->name }}">
                                <img src="{{ asset('upload/'.$project->image) }}" alt="{{ $project->translation->name }}">
                                <div class="overlay">
                                	<i class="fas fa-plus-circle"></i>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <section class="small-contact section">
    	<div class="container main-container">
    		<div class="row">
    			<div class="col-lg-12">
    				<h2>{!! trans('homepage.contact-title') !!}</h2>
    				<p>{{trans('homepage.contact-description')}}</p>
    				@if($contactPage = page('PageController'))
    					<a href="{{$contactPage->path}}" title="{{trans('common.contact-us')}}" class="main-btn">{{trans('common.contact-us')}}</a>
    				@endif
    			</div>
    		</div>
    	</div>
    </section>
    @if($teams)
    	<section class="teams-section section">
    		<div class="container main-container">
    			<div class="row">
    				<div class="col-lg-12">
    					<div class="heading-area">
        					<h2>{!! trans('homepage.teams-title') !!}</h2>
        					<p>>{{ trans('homepage.teams-subtitle') }}</p>
        					<span class="border-area"></span>
        				</div>
    				</div>
    				<div class="col-lg-12">
    					<div class="teams-slider owl-carousel">
        					@foreach($teams as $t)
        						<div class="item">
        							<img src="{{asset('upload/'.$t->image)}}" alt="{{$t->getTranslation()->name}}">
        							<div>
            							<h2 class="name">{{$t->getTranslation()->name}}</h2>
            							<h3>{{$t->getTranslation()->position}}</h3>
            							<ul>
            								@if(settings('facebook'))
            									<li>
            										<a href="{{settings('facebook')}}" title="Facebook" target="_blank">
            											<i class="fab fa-facebook-f"></i>
            										</a>
            									</li>
            								@endif
            								@if(settings('instagram'))
            									<li>
            										<a href="{{settings('instagram')}}" title="Instagram" target="_blank">
            											<i class="fab fa-instagram"></i>
            										</a>
            									</li>
            								@endif
            								@if(settings('twitter'))
            									<li>
            										<a href="{{settings('twitter')}}" title="Twitter" target="_blank">
            											<i class="fab fa-twitter"></i>
            										</a>
            									</li>
            								@endif
            							</ul>
        							</div>
        						</div>
        					@endforeach
        				</div>
    				</div>
    			</div>
    		</div>
    	</section>
    @endif
    @if($partners)
    	<section class="partners-section">
    		<div class="container main-container">
    			<div class="row">
    				<div class="col-lg-12">
    					<div class="partners-slider owl-carousel">
    						@foreach($partners as $partner)
    							<div class="item">
    								<a href="{{$partner->link}}" title="{{$partner->name}}" target="_blank">
    									<img src="{{asset('upload/'.$partner->image)}}" alt="{{$partner->name}}">
    								</a>
    							</div>
    						@endforeach
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
    @endif
@endsection

@push('scripts')
    <script src="{{ elixir('js/pages/projects.js') }}"></script>
    <script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
    <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
    
    <script>
		$(document).ready(function(){
			$(".fancy-gallery").fancybox();
		});

    </script>
@endpush
