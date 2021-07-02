@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/careers.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/pages/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/styles/slick-theme.css') }}">
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
    <div class="careers-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 left-side">
					<h2 class="title">{{ $page->getTranslation()->heading }}</h2>
					<div class="description">{!! nl2br($page->getTranslation()->description) !!}</div>
					@if($categories->count())
						<h2 class="title second">{{ trans('carrers.available_positions') }}</h2>
						<ul class="tabs">
							<li class="active" data-tab="all">{{ trans('carrers.all') }}</li>
							@foreach($categories as $category)
								<li data-tab="{{ str_slug($category->getTranslation()->name) }}">
									{{ $category->getTranslation()->name }}
								</li>
							@endforeach
						</ul>
						@foreach($categories as $category)
							<div class="tab active all {{ reduce_model_categories_to_css_classes($category) }}">
								<div class="accordion">
									@foreach($category->positions as $position)
										<div class="accordion-item">
										<h2 class="a-title">
											{{ $position->getTranslation()->name }}
											<i class="fa fa-plus"></i>
										</h2>
										<div class="a-content">
											<p>{!! nl2br($position->getTranslation()->short_description) !!}</p>
											@if($requirements = explode("\n", $position->getTranslation()->description))
												<p>{{ trans('carrers.requirements') }}:</p>
												<ul>
													@foreach($requirements as $requirement)
														<li>
															<i class="far fa-check-circle"></i>
															<span>{{ $requirement }}</span>
														</li>
													@endforeach
												</ul>
											@endif
											<a class="main-btn small purple js-apply-to-position" href="#" title="{{ trans('carrers.apply_now') }}" data-position="{{ $position->getTranslation()->name }}" data-category="{{ $category->getTranslation()->name }}">
												{{ trans('carrers.apply_now') }}
											</a>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							<div class="tab active {{ str_slug($category->getTranslation()->name) }}">
								<div class="accordion">
									@foreach($category->positions as $position)
                                        <div class="accordion-item">
										<h2 class="a-title">
											{{ $position->getTranslation()->name }}
											<i class="fa fa-plus"></i>
										</h2>
										<div class="a-content">
											<p>{!! nl2br($position->getTranslation()->short_description) !!}</p>
											@if($requirements = explode("\n", $position->getTranslation()->description))
												<p>{{ trans('carrers.requirements') }}:</p>
												<ul>
													@foreach($requirements as $requirement)
														<li>
															<i class="far fa-check-circle"></i>
															<span>{{ $requirement }}</span>
														</li>
													@endforeach
												</ul>
											@endif
											<a class="main-btn small purple js-apply-to-position" href="#" title="{{ trans('carrers.apply_now') }}" data-position="{{ $position->getTranslation()->name }}" data-category="{{ $category->getTranslation()->name }}">
												{{ trans('carrers.apply_now') }}
											</a>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						@endforeach
					@endif
				</div>
				<div class="col-lg-4 col-md-12 right-side">
					@if($sidebar_articles->count())
						<h2 class="title-sidebar margin">{{ trans('carrers.latest_articles') }}</h2>
						<div class="articles">
							@foreach($sidebar_articles as $article)
								<div class="item">
									<div class="img-section">
										<a href="{{ $article->path }}" title="{{ $article->getTranslation()->name }}">
											<img src="{{ $article->image_path }}" alt="{{ $article->getTranslation()->name }}">
										</a>
									</div>
									<div class="content">
										@if($article->published_at)
											<time>{{ $article->published_at->formatLocalized('%B %d, %Y') }}</time>
										@endif
										<h5>
											<a href="{{ $article->path }}" title="{{ $article->getTranslation()->name }}">
												{{ $article->getTranslation()->name }}
											</a>
										</h5>
									</div>
								</div>
							@endforeach
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
    @include('partials.partners')
@endsection

@push('scripts')
	<script src="{{ elixir('js/pages/careers.js') }}"></script>
    <script src="{{ asset('plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
    <script src="{{ asset('plugins/bee3D/bee3D.min.js') }}"></script>
    <script src="{{ asset('plugins/classie/classie.js') }}"></script>
    <script src="{{ elixir('js/pages/home.js') }}"></script>
    <script src="{{ asset('/plugins/photobox/photobox.js') }}"></script>
    <script src="{{ asset('/plugins/rangeslider/range-slider.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#gallery').photobox('.image', {thumbs: true, loop: true});
        });
    </script>
@endpush
